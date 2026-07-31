<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;

class UserObserver
{

    public function created(): void
    {
        Cache::forget('users');
    }

    public function updated(): void
    {
        Cache::forget('users');
    }

    public function deleted(): void
    {
        Cache::forget('users');
    }

}
