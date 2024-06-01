<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use App\Domain\AdManagement\Models\Favorite;

class EnsureUserIsAdminOrOwnerOfFavorite
{
    public function handle($request, Closure $next)
    {
        $user = $request->attributes->get('user');

        if ($user->role === 'admin') {
            return $next($request);
        }

        $favoriteId = $request->route('favorite');
        $favorite = Favorite::find($favoriteId);

        if (!$favorite) {
            return response()->json(['error' => 'Favorite not found'], 404);
        }

        if ($favorite->user_id === $user->user_id) {
            return $next($request);
        }

        return response()->json(['error' => 'Forbidden'], 403);
    }
}
