<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    //

    protected $fillable =[
        'user_id',
        'name',
        'location',
        'is_active'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
