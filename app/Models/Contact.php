<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name', 'user_id', 'phone_number'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
