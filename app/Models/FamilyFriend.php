<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use App\Enums\FamilyFriendStatus;

class FamilyFriend extends Model
{
    use HasUlids;

    protected $fillable = [];

    // *** user ***
    // Relationship - allows us to implement $familyFriend->user->full_name;
    public function user():BelongsTo {
        return $this->belongsTo(User::class);
    }

    // *** verifiedBy ***
    // Relationship - allows us to use $familyFriend->verifiedBy->full_name
    public function verifiedBy():BelongsTo {
        return $this->belongsTo(User::class, 'verified_by_user_id');
    }

    // *** updatedBy ***
    // Relationship - allows us to use $familyFriend->updatedBy->full_name
    public function updatedBy():BelongsTo {
        return $this->belongsTo(User::class, 'family_friend_status_updated_by_user_id');
    }

    // *** casts ***
    protected function casts(): array {
        return [
            'is_verified' => 'boolean',
            'verified_at' => 'datetime',
            'family_friend_status_updated_at' => 'datetime',
            'family_friend_status' => FamilyFriendStatus::class,
        ];
    }

}
