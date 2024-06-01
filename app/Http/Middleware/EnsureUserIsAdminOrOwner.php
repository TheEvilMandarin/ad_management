<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Domain\AdManagement\Models\Advertisement;

class EnsureUserIsAdminOrOwner
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->attributes->get('user');
        $advertisementId = $request->route('advertisement');

        if (!$advertisementId) {
            return response()->json(['error' => 'Advertisement ID is missing'], 400);
        }

        $advertisement = Advertisement::find($advertisementId);

        if (!$advertisement) {
            return response()->json(['error' => 'Advertisement not found'], 404);
        }

        if ($user->role !== 'admin' && $user->user_id !== $advertisement->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}
