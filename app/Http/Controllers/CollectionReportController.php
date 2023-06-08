<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AccountableForm;
use Illuminate\Support\Facades\DB;

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
        $collectors = User::get();

        $context = [
            'accountableFormTypesOfUser' => $accountable_form_types_of_user,
            'collectors' => $collectors
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

        return view ('collectionReport.individual');
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

    

}
