<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'surname',
        'avatar_url',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Accessor
    // reference $user->full_name
    // Note snake_case
    public function fullName():Attribute {
        return Attribute::make(
            get: fn () => "{$this->first_name} {$this->surname}",
        );
    }



    // **********************************
    // *** USER ROLES - RELATIONSHIPS ***
    // **********************************

    // *** superAdmin ***
    // Relationship - allows us to do $user->superAdmin !== null;
    // note camelCase
    public function superAdmin(): HasOne {
        return $this->hasOne(SuperAdmin::class);
    }

    // *** organisationAdministrator ***
    // Relationship - allows us to do $user->organisationAdministrator !== null 
    public function organisationAdministrator(): HasOne {
        return $this->hasOne(OrganisationAdministrator::class);
    }

    // *** manager ***
    // Relationship - allows us to do $user->manager !== null
    public function manager(): HasOne {
        return $this->hasOne(Manager::class);
    }
}
