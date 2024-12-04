<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    use HasFactory;
    protected $table = 'classes';
    protected $fillable = ['teacherid', 'classname', 'starttime', 'endtime', 'credit_hours'];
    // Relationship with teacher (one-to-many)
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacherid');
    }
    // Relationship with students (many-to-many)
    public function students()
    {
        return $this->belongsToMany(User::class, 'class_student', 'classid', 'studentid');
    }
    // Relationship with attendance (one-to-many)
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'classid');
    }
}
