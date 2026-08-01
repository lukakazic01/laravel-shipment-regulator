<?php

namespace App\Http\Controllers;

use App\Mappers\SelectOptionsMapper;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class AdminProfileController extends Controller
{

    public function index()
    {
        $users = User::query()->hydrate(Cache::remember('users', 600, fn () => User::all()->toArray()));
        return view('admin.profile.index', compact('users'));
    }

    public function edit(User $user) {
        $roles = SelectOptionsMapper::toSelectOptions(User::ALLOWED_ROLES);
        return view('admin.profile.edit', compact('user', 'roles'));
    }

}
