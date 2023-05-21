<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Office;
use App\Models\Position;
use App\Models\Assignment;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        
    }

    public function index () 
    {
        
    }

    public function create () 
    {
        $users = User::get();
        $positions = Position::get(); 
        $offices = Office::get();
    }

    public function store (Request $request)
    {
        
    }

    public function delete (Assignment $assignment) 
    {

    }
}
