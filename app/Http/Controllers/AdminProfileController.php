<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminProfileController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('admin.profile.index', compact('users'));
    }

}
