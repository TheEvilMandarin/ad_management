<?php

namespace App\Domain\AdManagement\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 *
 * @property string $category_name Название категории
 *
 * @property CarbonInterface|null $created_at
 * @property CarbonInterface|null $updated_at
 */
class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = ['category_name'];
}
