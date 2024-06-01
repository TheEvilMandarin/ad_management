<?php

namespace App\Http\ApiV1\Modules\Categories\Controllers;

use App\Domain\AdManagement\Categories\Actions\CreateCategoryAction;
use App\Domain\AdManagement\Categories\Actions\UpdateCategoryAction;
use App\Http\ApiV1\Modules\Categories\Queries\CategoryQuery;
use App\Http\ApiV1\Modules\Categories\Requests\CreateCategoryRequest;
use App\Http\ApiV1\Modules\Categories\Requests\UpdateCategoryRequest;
use App\Http\ApiV1\Modules\Categories\Resources\CategoryResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class CategoriesController extends Controller
{
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $categories = CategoryQuery::all(); // Adjust based on your actual query logic

        return CategoryResource::collection($categories);
    }

    public function store(CreateCategoryRequest $request, CreateCategoryAction $action): CategoryResource
    {
        $category = $action->execute($request->validated());

        return new CategoryResource($category);
    }

    public function show($id, CategoryQuery $query): CategoryResource
    {
        $category = $query->findOrFail($id);

        return new CategoryResource($category);
    }

    public function update($id, UpdateCategoryRequest $request, UpdateCategoryAction $action, CategoryQuery $query): CategoryResource
    {
        $category = $query->findOrFail($id);
        $category = $action->execute($category, $request->validated());

        return new CategoryResource($category);
    }

    public function destroy($id, CategoryQuery $query): JsonResponse
    {
        $category = $query->findOrFail($id);
        $category->delete();

        return response()->json(null, 204);
    }
}
