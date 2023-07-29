<?php

namespace App\Http\Controllers;

use App\Models\RevenueType;
use Illuminate\Http\Request;
use App\Models\AccountableForm;
use Illuminate\Support\Facades\DB;

class RevenueTypeController extends Controller
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

        // $collectors = User::get();

        $context = [
            'accountableFormTypesOfUser' => $accountable_form_types_of_user,
            // 'collectors' => $collectors
        ];
        return $context;
    }

    public function index () 
    {
        // this function lists all the revenue types

        $context = $this->userContext();
        $revenue_types = RevenueType::all();
        $context['revenue_types'] = $revenue_types;

        return $this->view('revenueType.index', $context);
    }
    
    public function create(){

        $context = $this->userContext();
        return view('revenueType.create', $context);
    }

    public function store (Request $request){

        // dd($request);

        // $context = $this->userContext();
        $this->validate($request, [
            'name' => 'required|max:255',
            // 'number' => 'required|unique:accountable_form_types|max:255'            
        ]);

        RevenueType::create([
            'name' => $request->name,
            // 'number' => $request->number,
            // 'default_amount' => $request->default_amount
        ]);

        return redirect()->route('revenue-type-index');
    }
}
