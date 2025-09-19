<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    //
    protected $fillable = [
        'user_id',
        'role_id'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function role()
    {
        return $this->hasMany(Role::class);
    }
}
