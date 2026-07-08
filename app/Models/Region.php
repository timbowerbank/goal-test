<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    use HasUlids;

    protected $fillable = [
    ];

    // *** organisation ***
    // Relationship - allows us to call $region->organisation
    public function organisation():BelongsTo {
        return $this->belongsTo(Organisation::class);
    }

    // *** createdBy ***
    // Relationship - allows us to call $region->createdBy->full_name
    public function createdBy():BelongsTo {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    // *** updatedBy ***
    // Relationship - allows us to call $region->updatedBy->full_name
    public function updatedBy():BelongsTo {
        return $this->belongsTo(User::class, 'updated_by_user_id');
    }


    // *** regionalOperators ***
    // Relationship - allows us to call $region->regionalOperators
    public function regionalOperators():BelongsToMany {
        return $this->belongsToMany(RegionalOperator::class)
            ->withPivot(
                [
                    'created_by_user_id',
                    'updated_by_user_id'
                    ]
            )
            ->withTimestamps();
    }

    // *** homes ***
    // Relationship - allows us to call $region->homes
    public function homes():HasMany {
        return $this->hasMany(Home::class);
    }

    // ******************
    // *** CASTS ********
    // ******************

    // No casts required
    // protected function casts():array {
    //     return [

    //     ];
    // }
}
