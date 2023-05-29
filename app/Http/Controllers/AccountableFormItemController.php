<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AccountableForm;
use Illuminate\Support\Facades\DB;
use App\Models\AccountableFormItem;
use App\Models\RevenueType;

class AccountableFormItemController extends Controller
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

    public function index(AccountableForm $accountableForm) 
    {
        $context = $this->userContext();
        
        // get revenue types 
        $revenue_types = RevenueType::get();
        $accountable_form_items = AccountableFormItem::where('accountable_form_id', $accountableForm->id)->get();
        
        $context['accountableForm'] = $accountableForm;
        $context['revenue_types'] = $revenue_types;
        $context['accountableFormItemsOfForm'] = $accountable_form_items;
        $context['method'] = 'add-accountable-form-item';

        return view('accountableForm.show', $context);

    }

    public function store ( AccountableForm $accountableForm, Request $request) 
    {
        // This function validates the input, then saves the data, then returns to accountable form function to enter additional items 
        $input = $this->validate($request, [
            // 'accountable_form_id' => 'required',
            'revenue_type_id' => 'required',
            'amount' => 'required'
        ]);

        AccountableFormItem::create( [
            'accountable_form_id' => $accountableForm->id,
            'revenue_type_id' => $input['revenue_type_id'],
            'amount' => $input['amount']
        ]);

        // redirect to accountable form 
        return redirect()->route('add-accountable-form-item', $accountableForm->id);

    }
}
