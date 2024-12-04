<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
     protected $table = 'attendances';
     protected $fillable = ['classid', 'studentid', 'isPresent', 'date', 'comments'];
     // Relationship with the student (belongs to a user)
     public function student()
     {
         return $this->belongsTo(User::class, 'studentid');
     }
     // Relationship with the class (belongs to a class)
     public function classSession()
     {
         return $this->belongsTo(ClassModel::class, 'classid');
     }
}
