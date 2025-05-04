<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    protected $fillable = ['firstname', 'lastname', 'country', 'address', 'city', 'email', 'state', 'postcode', 'order_id'];

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
