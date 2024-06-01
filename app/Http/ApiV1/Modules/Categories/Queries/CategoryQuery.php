<?php

namespace App\Http\ApiV1\Modules\Categories\Queries;

use App\Domain\AdManagement\Models\Category;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryQuery extends QueryBuilder
{
    public function __construct()
    {
        // Связь с моделью Category и инициализация QueryBuilder
        parent::__construct(Category::query());
        // Разрешение сортировки по определённым атрибутам
        $this->allowedSorts(['id', 'created_at', 'updated_at']);
        // Разрешение фильтрации по определённым атрибутам, если это необходимо
        $this->allowedFilters(['name', 'status']); // Пример фильтров
    }

    public static function all()
    {
        // Создаем экземпляр текущего класса
        $query = new self();
        // Возвращаем все результаты запроса
        return $query->get();
    }
}

