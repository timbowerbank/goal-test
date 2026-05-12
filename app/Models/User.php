<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


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

    // *** carer ***
    // Relationship - allows us to do $user->carer !== null
    public function carer():HasOne {
        return $this->hasOne(Carer::class);
    }

    // *** client ***
    // Relationship - allows us to do $user->client !== null
    public function client():HasOne {
        return $this->hasOne(Client::class);
    }

    // *** familyFriend ***
    // Relationship - allows us to do $user->familyFriend !== null
    public function familyFriend():HasOne {
        return $this->hasOne(FamilyFriend::class);
    }

    // ***************************
    // *** OTHER RELATIONSHIPS ***
    // ***************************

    // *** assignedToGoals ***
    // Relationship - allows us to call $user->assignedToGoals
    public function assignedToGoals():BelongsToMany {
        return $this->belongsToMany(Goal::class)
        ->withPivot(
            'assigned_by_user_id',
            'assigned_at',
            'ended_by_user_id',
            'ended_at',
        );
    }

}
