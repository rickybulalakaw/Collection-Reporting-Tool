<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AccountableForm;
use Illuminate\Support\Facades\DB;

class RealPropertyController extends Controller
{
    public function index ()
    {

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

        $collectors = User::get();

        $context = [
            'accountableFormTypesOfUser' => $accountable_form_types_of_user,
            'collectors' => $collectors
        ];
        return $context;
    }

    public function create (AccountableForm $accountableForm ) 
    {

        $context = $this->userContext();

        return view('accountableForm.create-rpt', $context);


    }

    public function store (Request $request)
    {

    }
}
