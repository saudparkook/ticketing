<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'value',
        'accesses_id',
    ];

    protected $attributes=[
        'status'=>'0',
    ];
    public function suborder(){
        return $this->hasOne(SubjectsOrder::class, 'id', 'title');

    }

}

