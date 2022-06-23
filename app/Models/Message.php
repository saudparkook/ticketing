<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'text',
        'audio',
        'file',
        'user_id',
        'sub_id',
    ];
    protected $attributes=[
        'status'=>'1',
        'number'=>'1',
    ];


    public function subject()
    {
        return $this->belongsTo(Subject::class,'sub_id','id');
    }
    public function getuser()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
