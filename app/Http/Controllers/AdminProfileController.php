<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class AdminProfileController extends Controller
{

    public function index()
    {
        $users = User::query()->hydrate(Cache::remember('admin-users', 600, fn () => User::all()->toArray()));
        return view('admin.profile.index', compact('users'));
    }

}
