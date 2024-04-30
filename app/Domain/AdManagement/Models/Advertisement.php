<?php

namespace App\Domain\AdManagement\Models;

use Carbon\CarbonInterface;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 *
 * @property int $user_id id пользователя
 * @property string $title Название объявления
 * @property string $description Описание объявления
 * @property float $price Стоимость товара
 * @property int $category_id id категории
 * @property CarbonInterface|null $date_posted Дата размещения объявления
 * @property string $status Состояние объявления
 * @property CarbonInterface|null $created_at
 * @property CarbonInterface|null $updated_at
 */
class Advertisement extends Model
{
    use HasFactory;
    protected $table = 'advertisements';
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'price',
        'category_id',
        'date_posted',
        'status',
    ];

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param DateTimeInterface $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format(DateTimeInterface::ATOM); // ISO-8601 format
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        // Связь с моделью Category
        return $this->belongsTo(Category::class);
    }
}
