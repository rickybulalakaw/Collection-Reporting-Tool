<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AccountableForm;
use Illuminate\Support\Facades\DB;
use App\Models\AccountableFormItem;
use App\Models\AccountableFormType;

class AccountableFormController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    private function userContext(){
        $accountable_form_types_of_user = DB::table('accountable_form_types')
        ->join('accountable_forms', 'accountable_forms.accountable_form_type_id', '=', 'accountable_form_types.id')
        ->join('users', 'accountable_forms.user_id', '=', 'users.id')
        // ->select('accountable_form_types.name')->distinct()
        ->select('accountable_form_types.id', 'accountable_form_types.name')->distinct()
        ->where('users.id', auth()->user()->id)
        ->where('accountable_forms.use_status', AccountableForm::IS_ASSIGNED)
        ->get();

        // $collectors = User::get();

        $context = [
            'accountableFormTypesOfUser' => $accountable_form_types_of_user,
            // 'collectors' => $collectors
        ];
        return $context;
    }

    public function index() 
    {

        $context = $this->userContext();
        // $count =  AccountableForm::count();

        // dd($context);
        // get accountable form types assigned to user 

        
        // return $count;

        // $accountable_form_types = DB::table('accountable_form_types')->get();
        // dd($accountable_form_types);

        // return $accountable_form_types;

        // var_dump($accountable_form_types);
        return view('accountableForm.index', $context);

    }

    public function create()
    {
        // This function shows form for creating accountable forms for the collection staff to fill out
        // This function is limited to MTO Custodian of Accountable forms 
        // This function requires to identify start and ending accountable form numbers and user as accountable officer 
    
        // get list of users 

        $users = User::get();

        $accountableFormTypes = AccountableFormType::get();
        $context = $this->userContext();
        $context['users'] = $users;
        $context['accountableFormTypes'] = $accountableFormTypes;

        // return view('accountableForm.create', compact('users', 'accountableFormTypes', 'context'));
        return view('accountableForm.create', $context);
    }

    public function store (Request $request){

        // This function will create records of accountable forms based on input 
        // This function will loop creating records of accountable forms based on start and end numbers
        
        // AccountableForm::create([]);

        $this->validate($request, [
            'accountable_form_type_id' => 'required',
            'user_id' => 'required',
            'start_number' => 'required',
            'end_number' => 'required',
        ]);

        $start_number = $request->start_number;
        $end_number = $request->end_number;
        $accountable_form_type_id =  $request->accountable_form_type_id;
        $user_id = $request->user_id;
        $use_status = AccountableForm::IS_ASSIGNED; 

        while($start_number <= $end_number){
            AccountableForm::create([
                'accountable_form_type_id' => $accountable_form_type_id,
                'user_id' => $user_id,
                'accountable_form_number' => $start_number,
                'use_status' => $use_status,
            ]);

            $start_number++;

        }

        return redirect()->route('create-accountable-form')->with('success', 'Accountable Forms created successfully') ;
        // return redirect()->route('home');

    
    }

    public function record (AccountableFormType $accountableFormType){ 
        // function generates smallest number of accountable form based on type and current user 


        $user = auth()->user()->id;

        $context = $this->userContext();

        

        // get smallest number based on user assigned to user and accountable form type

        // return $accountableFormType;

        $accountableForm = AccountableForm::where('user_id', $user)->where('accountable_form_type_id', $accountableFormType->id)->where('use_status', AccountableForm::IS_ASSIGNED)->orderBy('accountable_form_number', 'asc')->first();

        if(!$accountableForm){
            return redirect()->route('home')->with('error', 'No available accountable form of this type is available for you.') ;
        } 

        $date_today = date("Y-m-d");

        if ($accountableFormType->id == AccountableFormType::OFFICIAL_RECEIPT)
        {
            $isOfficialReceipt = true;
        } else {
            $isOfficialReceipt = false;
        }

        $context['name'] = $accountableFormType->name;
        $context['id'] = $accountableFormType->id;
        $context['accountable_form_type_id'] = $accountableFormType->id;
        $context['accountable_form_id'] = $accountableForm->id;
        $context['isOfficialReceipt'] = $isOfficialReceipt;
        $context['accountable_form_number'] = $accountableForm->accountable_form_number;
        $context['date_today'] = $date_today;

        return view('accountableForm.record', $context);

    }

    public function fill (AccountableForm $accountableForm, Request $request){
        // AccountableFormType is submitted in request 

        // dd ($accountableForm);
        // dd($request);
        if($request->is_cancelled){
            $this->validate($request, [
                'form_date' => 'required'

            ]);

            $used_status = AccountableForm::IS_CANCELLED;
        } else {

            if (($request->accountable_form_type_id == AccountableFormType::CTC_INDIVIDUAL) || ($request->accountable_form_type_id == AccountableFormType::CTC_CORPORATION))
            {

                $this->validate($request, [
                    'form_date' => 'required'
                ]);
            } else {

                $this->validate($request, [
                    'form_date' => 'required',
                    'payor' => 'required',
                ]);
            }

            $used_status = AccountableForm::IS_USED;
        }

        // DB::table('bills')->where('id', $bill->id)->update($updatedBill);
        DB::table('accountable_forms')->where('id', $request->accountable_form_id)->update([
            'form_date' => $request->form_date,
            'payor' => $request->payor,
            'use_status' => $used_status,
            'accounting_status' => AccountableForm::IS_SUBMITTED
        ]);

        if($used_status == AccountableForm::IS_CANCELLED){
            return redirect()->route('record-accountable-form', $request->accountable_form_type_id )->with('success', 'Accountable Form is cancelled') ;
        }

        // add logic depending on account form type or revenue type

        if(($request->accountable_form_type_id == AccountableFormType::CTC_INDIVIDUAL) || ($request->accountable_form_type_id == AccountableFormType::CTC_CORPORATION)){
            return redirect()->route('record-community-tax-individual', $request->accountable_form_id );

        } elseif($request->accountable_form_type_id == AccountableFormType::RPT_RECEIPT) {

            // redirect to fill out form for RPT related fees

            return redirect()->route('record-real-property-tax-receipt', $request->accountable_form_id ); 

        } else {
            // redirect to generic form to enter type of data one by one 
            return redirect()->route('add-accountable-form-item', $request->accountable_form_id);

        }

        




        // if no other data requirements, go to enter accountable form items linked to accountable form id 


        // return redirect()->route('show-accountable-form', $request->accountable_form_id );
    }


    public function show (AccountableForm $accountableForm){
        // This function will show the details of an accountable form that has been filled out 

        $required_status = AccountableForm::IS_USED;

        if($accountableForm->use_status !== $required_status){
            return redirect()->route('home')->with('error', 'This Accountable Form is not used') ;
        }

        $disallowed_types = [
            AccountableFormType::CTC_CORPORATION,
            AccountableFormType::CTC_INDIVIDUAL,
            AccountableFormType::RPT_RECEIPT
        ];
        
        if(in_array($accountableForm->accountable_form_type_id, $disallowed_types)){
            return redirect()->route('home')->with('error', 'Invalid parameter entered');
        }

        $accountableFormItems = AccountableFormItem::with(['revenue_type'])->where('accountable_form_id', $accountableForm->id)->get();
        // AccountableFormItem::where('accountable_form_id', $accountableForm->id)->get();

        $context = $this->userContext();
        $context['accountableFormItemsOfForm'] = $accountableFormItems;
        $context['accountableForm'] = $accountableForm;
        $context['method'] = 'show';

        // dd($accountableFormItems);
        // dd($data);
        // show details  of accountable form

        return view('accountableForm.show', $context);


        // get accountable form items linked to accountable form id

    }

    public function review (AccountableForm $accountableForm){
        // This function will show the details of an accountable form that has been filled out 
        // this allows comment by consolidator / approver

        $required_status = AccountableForm::IS_USED;

        if($accountableForm->use_status !== $required_status){
            return redirect()->route('home')->with('error', 'This Accountable Form is not used') ;
        }

        $disallowed_types = [
            AccountableFormType::CTC_CORPORATION,
            AccountableFormType::CTC_INDIVIDUAL,
            AccountableFormType::RPT_RECEIPT
        ];
        
        if(in_array($accountableForm->accountable_form_type_id, $disallowed_types)){
            return redirect()->route('home')->with('error', 'Invalid parameter entered');
        }

        $accountableFormItems = AccountableFormItem::with(['revenue_type'])->where('accountable_form_id', $accountableForm->id)->get();
        // AccountableFormItem::where('accountable_form_id', $accountableForm->id)->get();

        $context = $this->userContext();
        $context['accountableFormItemsOfForm'] = $accountableFormItems;
        $context['accountableForm'] = $accountableForm;
        $context['method'] = 'show';

        // dd($accountableFormItems);
        // dd($data);
        // show details  of accountable form

        return view('accountableForm.show', $context);


        // get accountable form items linked to accountable form id

    }


    public function edit (AccountableForm $accountableForm)
    {

    }

    public function update (AccountableForm $accountableForm) 
    {
    
    }

    public function destroy (AccountableForm $accountableForm) 
    {

        // function nullifies an accountable form 

        // loops all accountable form items and nullifies them 
    
    }



}
