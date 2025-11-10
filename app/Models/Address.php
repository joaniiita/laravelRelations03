<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Address extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'user_id',
        'country',
        'zipcode',
    ];

    function user()
    {
        return $this->belongsTo(User::class);
    }
}
