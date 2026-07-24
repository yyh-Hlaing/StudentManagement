<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $fillable = ['class_room_id', 'name', 'roll_no', 'email', 'dob', 'image'];
    public function classRoom() {
    return $this->belongsTo(ClassRoom::class); 
}
}