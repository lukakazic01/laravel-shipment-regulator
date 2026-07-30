<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'status', 'avatar'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    const string ROLE_CLIENT = 'client';
    const string ROLE_ADMINISTRATOR = 'administrator';
    const string ROLE_TRUCKER = 'trucker';

    const array ALLOWED_ROLES = [self::ROLE_CLIENT, self::ROLE_ADMINISTRATOR, self::ROLE_TRUCKER];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function shipments(): HasMany {
        return $this->hasMany(Shipment::class, 'user_id', 'id');
    }

    public function role(): Attribute {
        return Attribute::make(
            set: fn ($value) => in_array(self::ALLOWED_ROLES, $value) ? $value : self::ROLE_CLIENT,
        );
    }
}
