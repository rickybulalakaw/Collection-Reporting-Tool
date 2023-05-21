<?php

namespace App\Http\Controllers;

use App\Models\AccountableForm;
use Illuminate\Http\Request;

class AccountableFormItemController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        
    }

    public function index(AccountableForm $accountableForm) 
    {

    }

    public function store ( AccountableForm $accountableForm, Request $request) 
    {

    }
}
