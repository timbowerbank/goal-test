<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class SuperAdmin extends Model
{
    use HasUlids;

    protected $fillable = [];

    // *** user ***
    // allows you to $superAdmin->user->full_name;
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
