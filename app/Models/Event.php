<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Event extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'event_name', 'event_detail', 'event_type_id'
    ];

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function eventType(){
        return $this->belongsTo(EventType::class);
    }
}
