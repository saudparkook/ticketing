<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueueSMS extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'to_number',
        'message_id',
        'data',
        'status'
    ];

    protected $attributes=[
        'status'=>'0'
    ];
}
