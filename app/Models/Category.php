<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Category extends Model
{
    use HasFactory;

   
    protected $fillable = [
        'user_id',
        'name',
        'type',
        'description',
        'budget',
        'color',
    ];

    /**
     * A category belongs to a user
     * (nullable = shared/default category)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope: Get only expense categories
     */
    public function scopeExpense($query)
    {
        return $query->where('type', 'expense');
    }

    /**
     * Scope: Get only income categories
     */
    public function scopeIncome($query)
    {
        return $query->where('type', 'income');
    }

    /**
     * Scope: Get categories for a user + shared ones
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId)
                     ->orWhereNull('user_id');
    }
    public function expenses()
{
    return $this->hasMany(Expense::class);
}

public function budgets()
{
    return $this->hasMany(Budget::class);
}
public function transactions()
{
    return $this->hasMany(\App\Models\Transaction::class);
}
}