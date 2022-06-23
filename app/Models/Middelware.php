<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Middelware extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'user_access',
        'pagename',
        'status',
    ];

    public function getusers()
    {
        return $this->hasMany(User::class,'access','user_access');
    }
}
