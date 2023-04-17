<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "product_id",
        "order_contact_id",
        "payment_type", // remove
        "payment_method",
        "payment_image_url", // remove
        "total_price",
        "amount_paid",
        "trackingnumber", 
        "trackingnumberP",
        "status",
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function orderContact(): HasOne
    {
        return $this->hasOne(OrderContact::class, 'id', 'order_contact_id');
    }
}
