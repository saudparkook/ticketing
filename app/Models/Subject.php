<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'order',
        'user_id',
        'code',
    ];
    protected $attributes=[
        'status'=>'0',
    ];

    // public function message($id)
    // {
    //     return Message::where('sub_id','=',$id)->get();
    // }
    public function messages()
    {
        return $this->hasMany(Message::class,'sub_id','id');
    }
    public function getorder()
    {
        return $this->belongsTo(SubjectsOrder::class,'order','id');
    }
    public function getuser()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function getuseraccess()
    {
        return $this->hasMany(Middelware::class,'pagename','order');
    }
}
