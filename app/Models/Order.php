<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'user_name',
        'user_email',
        'phone',
        'address',
        'total',
        'payment_method',
        'note',
        'status',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
