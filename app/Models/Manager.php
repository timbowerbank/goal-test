<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use App\Enums\ManagerStatus;

class Manager extends Model
{
    use HasUlids;

    protected $fillable = [];

    // *** user ***
    // relationship - allows us to use $manager->user->full_name
    public function user() {
        return $this->belongsTo(User::class);
    }

    // *** verifiedBy ***
    // relationship - allows us to use $manager->verifiedBy->full_name
    public function verifiedBy() {
        return $this->belongsTo(User::class, 'verified_by_user_id');
    }

    // *** updatedBy ***
    // relationship - allows us to use $manager->updatedBy->full_name
    public function updatedBy() {
        return $this->belongsTo(User::class, 'manager_status_updated_by');
    }


    // *** casts ***
    protected function casts(): array {
        return [
            'manager_status' => ManagerStatus::class,
            'is_verified' => 'boolean',
            'verified_at' => 'datetime',
            'manager_status_updated_at' => 'datetime',
        ];
    }

}
