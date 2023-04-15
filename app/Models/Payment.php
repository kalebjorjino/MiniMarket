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
        // 'deadline',
        // "schedule_id",
        "payment_type",
        "payment_method",
        "payment_image_url",
        "total_price",
        "amount_paid",
        "trackingnumber", // ?
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
