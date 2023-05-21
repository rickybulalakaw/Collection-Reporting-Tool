<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\AccountableForm;
use Illuminate\Support\Facades\DB;
use App\Models\AccountableFormItem;
use Illuminate\Contracts\Database\Eloquent\Builder;

class CollectorController extends Controller
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

        $collectors = User::get();

        $context = [
            'accountableFormTypesOfUser' => $accountable_form_types_of_user,
            'collectors' => $collectors
        ];
        return $context;
    }

    public function index()
    {

    }

    public function supervised () 
    {
        // This function lists the users that are supervised by the current user.

        $context = $this->userContext();
        $date = date('Y-m-d');
        
        // $collectors = User::with(['accountable_forms', 'accountable_form_items', 'assignment'])
        // ->get();

        $collectors = DB::table('accountable_forms')
            // ->select('users.id', 'users.name', 'users.last_name', 'accountable_form_items.amount')
            ->select(DB ::raw('users.id, users.name, users.last_name, sum(accountable_form_items.amount) as total'))
            ->join('users', 'users.id', '=', 'accountable_forms.user_id')
            ->join('accountable_form_items', 'accountable_form_items.accountable_form_id', '=', 'accountable_forms.id')
            ->join('assignments', 'assignments.user_id', '=', 'users.id')
            ->where('accountable_forms.date', $date)
            ->where('assignments.supervisor_id', auth()->user()->id)
            ->groupBy('users.id')
            ->get();

            // dd($collectors);

        $context['collectors2'] = $collectors;
        $context['page_title'] = 'Supervised Collectors';

        return view('collectors.index', $context);
        // dd($supervised_collectors);
    }
}
