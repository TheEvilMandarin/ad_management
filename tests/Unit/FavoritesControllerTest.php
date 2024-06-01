<?php

namespace Tests\Unit;

use App\Domain\AdManagement\Models\Favorite;
use App\Domain\AdManagement\Models\Advertisement;
use App\Domain\AdManagement\Models\Category;
use App\Http\ApiV1\Modules\Favorites\Controllers\FavoritesController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Mockery;
use Tests\TestCase;

class FavoritesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        // Создаем пользователя
        $user = (object) ['user_id' => 1];

        // Создаем категорию
        $category = Category::factory()->create();

        // Создаем объявление
        $advertisement = Advertisement::factory()->create([
            'category_id' => $category->id,
            'user_id' => 1, // Фиктивный ID пользователя
        ]);

        // Создаем тестовые данные для избранного
        Favorite::factory()->create([
            'user_id' => 1,
            'ad_id' => $advertisement->id,
        ]);

        // Создаем запрос и добавляем атрибуты
        $request = Request::create('/favorites', 'GET');
        $request->attributes->set('user', $user);

        // Устанавливаем атрибуты запроса вручную
        $this->app['request'] = $request;

        // Тестируемый контроллер
        $controller = new FavoritesController();

        // Вызов метода
        $response = $controller->index();

        // Проверка результатов
        $this->assertInstanceOf(AnonymousResourceCollection::class, $response);
        $this->assertCount(1, $response->collection);
    }
}
