<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Reward extends Model
{
    use HasUlids, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'image_url'
    ];

    // *** goal() ***
    // Relationship - allows us to implement $reward->goal
    public function goal():HasOne {
        return $this->hasOne(Goal::class);
    }
}
