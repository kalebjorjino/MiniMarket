<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    use HasFactory;

     protected $fillable = [
        'expense_date',
        'quantity',
        'total_price',
        'supplier',
        'product_id',
    ];

    /**
     * Get the item that matches the item restocked.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
