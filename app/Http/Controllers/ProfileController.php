<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewAvatarRequest;

class ProfileController extends Controller
{

    public function index() {
        return view('profile.index');
    }

    public function changeAvatar(NewAvatarRequest $request) {
        $this->deleteImageFromStorage(auth()->user()->avatar ?? '', "images/avatars/");
        $name = $this->uploadImage("profile_image", "images/avatars/");
        auth()->user()->update(['avatar' => $name]);
        return redirect()->back();
    }

}
