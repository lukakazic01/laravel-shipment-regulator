<?php

namespace App\Http\Controllers;

use App\Mappers\SelectOptionsMapper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;

class AdminProfileController extends Controller
{

    public function index()
    {
        $users = User::query()->hydrate(
            Cache::remember('users', 600, fn () => User::all()->toArray())
        )->reject(fn ($user) => $user->id === auth()->id());
        return view('pages.admin.profile.index', compact('users'));
    }

    public function updateRole(Request $request, User $user) {
        $validated = $request->validate([
            'role' => [
                'required',
                'string',
                Rule::in(User::ALLOWED_ROLES),
            ]
        ]);
        $user->forceFill($validated)->save();
        return redirect()->route('admin.profile.index');
    }

}
