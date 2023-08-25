<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserRequest extends Model
{
    use HasFactory;

    public const STATUS_ACTIVE   = 'ACTIVE';
    public const STATUS_RESOLVED = 'RESOLVED';

    protected $fillable = [
        'user_id',
        'status',
        'message',
    ];

    public function scopeWhereDateBetween(Builder $query, string $fieldName, array $date)
    {
        return $query
            ->when(
                isset($date[0]),
                fn(Builder $query) => $query->whereDate($fieldName, '>=', $date[0]),
            )
            ->when(
                isset($date[1]),
                fn(Builder $query) => $query->whereDate($fieldName, '<=', $date[1]),
            );
    }

    public function comment(): HasOne
    {
        return $this->hasOne(UserRequestComment::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
