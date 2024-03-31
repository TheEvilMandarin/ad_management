<?php

namespace App\Domain\AdManagement\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 *
 * @property int $user_id id пользователя
 * @property int $ad_id id объявления
 * @property CarbonInterface|null $created_at
 * @property CarbonInterface|null $updated_at
 */
class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ad_id',
    ];

    public function advertisement(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Advertisement::class, 'ad_id');
    }
}
