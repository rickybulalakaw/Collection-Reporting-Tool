<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\AccountableForm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Gate;

class CollectionReportController extends Controller
{

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

        // $collectors = User::where('status', User::STATUS_ACTIVE)->get();


        $message_count = DB::table('messages')
            ->select('sender.first_name as first_name', 'sender.last_name as last_name', 'messages.subject as subject', 'messages.created_at as created_at')
            ->join('users as recipient', 'messages.recipient_user_id', '=', 'recipient.id')
            ->join('users as sender', 'messages.user_id', '=', 'sender.id')
            ->where('messages.recipient_user_id', auth()->user()->id)
            ->where('messages.status', Message::STATUS_UNREAD)
            ->count();


        $context = [
            'accountable_form_types_of_user' => $accountable_form_types_of_user,
            'message_count' => $message_count,
        ];
        
        return $context;
    }
    
    public function index () 
    {

    }

    public function draft ()
    {
        // This function displays the draft individual RCD of a collector 
        // This is limited to a person with function of collector 
        // By default, this displays the RCD of the individual for the date today 

        $context = $this->userContext();

        // dd($context);

        $accountable_forms_for_draft = DB::table('accountable_forms')
        ->join('accountable_form_types', 'accountable_forms.accountable_form_type_id', '=', 'accountable_form_types.id')
        ->leftJoin('accountable_form_items', 'accountable_forms.id', '=', 'accountable_form_items.accountable_form_id') 
        ->select('accountable_forms.id as form_id', 'accountable_forms.accountable_form_number as form_number', 'accountable_forms.form_date as form_date', 'accountable_forms.use_status as use_status', 'accountable_forms.payor as payor', 'accountable_form_types.name as form_type', DB::raw('SUM(accountable_form_items.amount) AS total_amount'))
        ->groupBy('accountable_forms.id')
        ->where('accountable_forms.user_id', auth()->user()->id)
        ->whereIn('accountable_forms.use_status', [AccountableForm::IS_USED, AccountableForm::IS_CANCELLED])
        ->whereIn('accountable_forms.accounting_status', [AccountableForm::IS_SUBMITTED])
        ->where('accountable_forms.form_date', date('Y-m-d'))
        ->orderBy('accountable_form_types.name', 'asc')
        ->get();

        if(count($accountable_forms_for_draft) < 1){
            return redirect()->route('home')->with('error', 'No draft RCD found for today');
        }
        // dd($accountable_forms_for_draft);

        $context['used_accountable_forms'] = $accountable_forms_for_draft;
        $context['use_status_cancelled'] = AccountableForm::IS_CANCELLED;

        // get messages 

        $subject = "Individual RCD for " . date('Y-m-d');

        // $messages = DB::table('messages')->where('subject', $subject)->get();
        $messages = Message::with('user')->where('subject', $subject)->get();
        $context['messages'] = $messages;



        // $context['supervisor_id'] = auth()->user()->supervisor_id;

        // dd($context);

        return view ('collectionReport.individual', $context);
    }

    public function submit ()
    {
        // This function is limited to today only
    }

    public function review (User $user) 
    {
        // This function displays the accountable forms of User
        // This is limited to a person with function of consolidator 

    }

    public function viewIndividual(User $user, $date = null)
    {

        // $user is the person who submitted the individual report 


    }

    public function collectors()
    {
        // this method shows list of staff under the user 
        // the user must be a supervisor

        
        if (! Gate::allows('is-admin', auth()->user()->id)) {
            abort(403);
        }
    }

    

}
