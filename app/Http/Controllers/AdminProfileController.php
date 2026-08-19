<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class AdminProfileController extends Controller
{

    public function index()
    {
        $users = User::query()->hydrate(
            Cache::remember('users', 600, fn () => User::all()->toArray())
        )->reject(fn ($user) => $user->id === auth()->id());
        return view('pages.admin.profile.index', compact('users'));
    }

}
