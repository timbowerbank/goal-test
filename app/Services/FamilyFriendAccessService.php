<?php

namespace App\Services;

use App\Models\User;
use App\Models\FamilyFriend;
use App\Enums\FamilyFriendStatus;

class FamilyFriendAccessService {

    // *** checkFamilyFriendHasClient() ***
    public function checkFamilyFriendHasClient(User $user) {
        $familyFriend = $user->familyFriend;

        if(!$familyFriend) {
            return false;
        }

        // check if verified
        if(!$familyFriend->is_verified) {
            return false;
        }

        // check status
        if($familyFriend->family_friend_status !== FamilyFriendStatus::Active) {
            return false;
        }

        // must have an active client
        return $familyFriend->clients()
            ->wherePivotNull('ended_at')
            ->exists();
    }


}