<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('dashboard.users.index', compact('users'));
    }

    public function view($id)
    {
        $users =  User::find($id);
        return view('dashboard.users.view', compact('users'));
    }
}
