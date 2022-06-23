<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserAccess extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'title',
        'homepage',
        'status'
    ];
    protected $attributes=[

    ];

    public function middelware($id)
    {
        return Middelware::where('user_access','=',$id)->select('pagename','status')->get();
    }

}
