<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'amount',
        'month',
    ];

    /**
     * A budget belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A budget belongs to a category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function transactions()
{
    return $this->hasMany(Transaction::class, 'category_id', 'category_id')
                ->where('user_id', $this->user_id)
                ->whereMonth('date', now()->parse($this->month)->month)
                ->whereYear('date', now()->parse($this->month)->year)
                ->where('type', 'expense');
}
}
