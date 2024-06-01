<?php

namespace App\Http\ApiV1\Modules\Favorites\Controllers;

use App\Domain\AdManagement\Models\Favorite;
use App\Domain\AdManagement\Favorites\Actions\CreateFavoriteAction;
use App\Domain\AdManagement\Favorites\Actions\DeleteFavoriteAction;
use App\Http\ApiV1\Modules\Favorites\Requests\CreateFavoriteRequest;
use App\Http\ApiV1\Modules\Favorites\Resources\FavoriteResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class FavoritesController extends Controller
{
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        Log::info('Executing index method in FavoritesController');

        // Получаем user_id из токена
        $user = request()->attributes->get('user');
        $userId = $user->user_id;

        // Фильтруем избранное по user_id
        $favorites = Favorite::where('user_id', $userId)->get();

        Log::info('Executing index method in FavoritesController: user ', [$userId]);
        Log::info('Executing index method in FavoritesController: favorites ', [$favorites]);

        return FavoriteResource::collection($favorites);
    }

    public function store(CreateFavoriteRequest $request, CreateFavoriteAction $action)
    {
        Log::info('Executing store method in FavoritesController', ['request' => $request->all()]);
        $validated = $request->validated();

        $user = $request->attributes->get('user');
        Log::info('User data from request', ['user' => $user]);

        if (isset($user->user_id)) {
            $validated['user_id'] = $user->user_id;
        } else {
            Log::error('User ID is missing in the request', ['request' => $request->all()]);
            return response()->json(['error' => 'User ID is missing'], 400);
        }

        $favorite = $action->execute($validated);

        Log::info('Favorite created', ['favorite' => $favorite]);

        return new FavoriteResource($favorite);
    }

    public function show(int $id): FavoriteResource
    {
        Log::info('Executing show method in FavoritesController', ['id' => $id]);
        $favorite = Favorite::findOrFail($id);

        return new FavoriteResource($favorite);
    }

    public function destroy(int $id, DeleteFavoriteAction $action): JsonResponse
    {
        Log::info('Executing destroy method in FavoritesController', ['id' => $id]);
        $favorite = Favorite::findOrFail($id);
        $action->execute($favorite);

        Log::info('Favorite deleted', ['favorite' => $favorite]);

        return response()->json(null, 204);
    }
}
