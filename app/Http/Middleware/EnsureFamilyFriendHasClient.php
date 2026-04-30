<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Services\FamilyFriendAccessService;
use App\Enums\FamilyFriendStatus;

class EnsureFamilyFriendHasClient
{

    public function __construct(protected FamilyFriendAccessService $accessService){}
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $openRoutes = ['family-friend.pending-verification', 'family-friend.inactive'];
        if(in_array($request->route()->getName(), $openRoutes)) {
            return $next($request);
        }

        // get the family friend
        $familyFriend = Auth::user()->familyFriend;

        // check if family friend is valid
        if(!$familyFriend) {
            abort(403, 'Access denied.');
        }

        // check if the family friend is not verified
        if(!$familyFriend->is_verified) {
            return redirect()->route('family-friend.pending-verification');
        }

        // check if the family friend is active
        if($familyFriend->family_friend_status !== FamilyFriendStatus::Active ) {
            return redirect()->route('family-friend.inactive');

        }

        // check if the family friend actually has a client
        if(!$this->accessService->checkFamilyFriendHasClient(Auth::user())) {
            abort(403, 'You have not been allocated any clients.');
        }

        return $next($request);
    }
}
