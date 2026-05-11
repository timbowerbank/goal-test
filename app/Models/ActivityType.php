<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;


class ActivityType extends Model
{
    use HasUlids;

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;
}
