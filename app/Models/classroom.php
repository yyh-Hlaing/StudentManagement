<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class classroom extends Model
{
    //
    protected $table = 'class_rooms';
    protected $fillable = ['name'];
    public function students() {
    return $this->hasMany(Student::class);
}
}
