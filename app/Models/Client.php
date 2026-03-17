<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use App\Enums\ClientStatus;

class Client extends Model
{
    use HasUlids;

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
