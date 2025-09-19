<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
        'user_id','product_id','store_id','customer_id','quantity','total_price'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

        public function store(){
        return $this->belongsTo(Store::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
