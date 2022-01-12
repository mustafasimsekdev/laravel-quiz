<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ToDoes extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'to_does';
    protected $guarded = [];


    public function getUser(){
        return $this->belongsTo(User::class, 'recording_id', 'id');
    }
}
