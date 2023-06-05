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

    public function individual (User $user) 
    {
        // User is a collector 



    }

    public function consolidated (User $user)
    {
        // User is a Supervisor 

    }
}
