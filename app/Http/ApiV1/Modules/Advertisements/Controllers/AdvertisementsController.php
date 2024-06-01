<?php

namespace App\Http\ApiV1\Modules\Advertisements\Controllers;

use App\Domain\AdManagement\Advertisements\Actions\CreateAdvertisementAction;
use App\Domain\AdManagement\Advertisements\Actions\DeleteAdvertisementAction;
use App\Domain\AdManagement\Advertisements\Actions\UpdateAdvertisementAction;
use App\Http\ApiV1\Modules\Advertisements\Queries\AdvertisementQuery;
use App\Http\ApiV1\Modules\Advertisements\Requests\CreateAdvertisementRequest;
use App\Http\ApiV1\Modules\Advertisements\Requests\UpdateAdvertisementRequest;
use App\Http\ApiV1\Modules\Advertisements\Resources\AdvertisementResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class AdvertisementsController extends Controller
{
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        Log::info('Executing index method in AdvertisementsController');
        $advertisements = AdvertisementQuery::allWithFilters(request());

        return AdvertisementResource::collection($advertisements);
    }

    public function store(CreateAdvertisementRequest $request, CreateAdvertisementAction $action)
    {
        Log::info('Executing store method in AdvertisementsController', ['request' => $request->all()]);
        $validated = $request->validated();

        $user = $request->attributes->get('user');
        Log::info('User data from request', ['user' => $user]);

        if (isset($user->user_id)) {
            $validated['user_id'] = $user->user_id;
        } else {
            Log::error('User ID is missing in the request', ['request' => $request->all()]);
            return response()->json(['error' => 'User ID is missing'], 400);
        }

        Log::info('Validated data after adding user_id and status', ['validated' => $validated]);

        $advertisement = $action->execute($validated);

        Log::info('Advertisement created', ['advertisement' => $advertisement]);

        return new AdvertisementResource($advertisement);
    }

    public function show(int $id, AdvertisementQuery $query): AdvertisementResource
    {
        Log::info('Executing show method in AdvertisementsController', ['id' => $id]);
        $advertisement = $query->findOrFail($id);

        return new AdvertisementResource($advertisement);
    }

    public function update(int $id, UpdateAdvertisementRequest $request, UpdateAdvertisementAction $action, AdvertisementQuery $query): AdvertisementResource
    {
        Log::info('Executing update method in AdvertisementsController', ['id' => $id, 'request' => $request->all()]);
        $advertisement = $query->findOrFail($id);

        $updatedAdvertisement = $action->execute($advertisement, $request->validated());

        Log::info('Advertisement updated', ['advertisement' => $updatedAdvertisement]);

        return new AdvertisementResource($updatedAdvertisement);
    }

    public function destroy(int $id, DeleteAdvertisementAction $action, AdvertisementQuery $query): JsonResponse
    {
        Log::info('Executing destroy method in AdvertisementsController', ['id' => $id]);
        $advertisement = $query->findOrFail($id);
        $action->execute($advertisement);

        Log::info('Advertisement deleted', ['advertisement' => $advertisement]);

        return response()->json(null, 204);
    }
}
