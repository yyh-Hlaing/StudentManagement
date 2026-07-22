<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $fillable = ['class_room_id', 'name', 'roll_no', 'email', 'dob', 'image'];
    public function classRoom() {
    return $this->belongsTo(ClassRoom::class); 
}
}