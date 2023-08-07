<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index () 
    {

    }

    public function assignRole(User $user)
    {

    }

    public function assignRoleSave(User $user, Request $request)
    {

    }

    public function removeRole(User $user)
    {

    }

    
    
}
