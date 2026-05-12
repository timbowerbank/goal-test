<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\ClientStatus;

class Client extends Model
{
    use HasUlids, SoftDeletes;

    protected $fillable = [];


    // *** user ***
    // Relationship - allows us to use $client->user->full_name;
    public function user():BelongsTo {
        return $this->belongsTo(User::class);
    }

    // *** home ***
    // Relationship - allows us to use $client->home->home_name
    public function home(): BelongsTo {
        return $this->belongsTo(Home::class, 'home_id');
    }

    // *** verifiedBy ***
    // Relationship - Allows us to use $client->verifiedBy->full_name
    public function verifiedBy(): BelongsTo {
        return $this->belongsTo(User::class, 'verified_by_user_id');
    }

    // *** statusUpdatedBy ***
    // Relationship - Allows us to use $client->statusUpdatedBy->full_name
    public function statusUpdatedBy(): BelongsTo {
        return $this->belongsTo(User::class, 'client_status_updated_by_user_id');
    }

    // *** familyFriends ***
    // Relationship - Allows us to use $client->familyFriends
    public function familyFriends(): BelongsToMany {
        return $this->belongsToMany(FamilyFriend::class, 'client_family_friend')
        ->withPivot([
            'started_at',
            'ended_at',
            'created_by_user_id',
            'updated_by_user_id'])
        ->withTimestamps();
    }


    // goals **************************

    // *** goals ***
    // Relationship - allows us to call $client->goals;
    public function goals():HasMany {
        return $this->hasMany(Goal::class, 'client_user_id', 'user_id');
    }

    // *** casts() ***
    protected function casts():array {
        return [
            'is_verified' => 'boolean',
            'client_status' => ClientStatus::class,
            'verified_at' => 'datetime',
            'client_status_updated_at' => 'datetime',
        ];
    }
    
}
