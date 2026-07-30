<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UserTrucker implements ValidationRule
{

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $isTrucker = User::query()->where(['id' => $value, 'role' => User::ROLE_TRUCKER])->exists();
        if (!$isTrucker) {
            $fail('User must be a trucker');
        }
    }
}
