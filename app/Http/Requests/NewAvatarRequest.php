<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewAvatarRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'profileImage' => 'required|image|mimes:jpeg,png,jpg,webp,avif|max:4096',
        ];
    }
}
