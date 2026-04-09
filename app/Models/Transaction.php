<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\BelongsToOrganization;


class Transaction extends Model
{
    use HasFactory;
    use BelongsToOrganization;


    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'user_id',
        'organization_id',
        'category_id',
        'amount',
        'type',
        'description',
        'date',
    ];

    /**
     * Cast attributes
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'date' => 'date',
    ];

    /**
     * Relationships
     */

    // Transaction belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Transaction belongs to a Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Scopes (useful for dashboard & filtering)
     */

    // Scope to filter by type (income/expense)
    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Scope to filter by date range
    public function scopeBetweenDates($query, $start, $end)
    {
        return $query->whereBetween('date', [$start, $end]);
    }

    // Scope to filter by user
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}