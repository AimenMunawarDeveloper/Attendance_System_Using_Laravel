<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    
    protected $table = 'users'; 
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname', 'email', 'password', 'class', 'role','email_verified_at'
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }    
    // Relationship with attendance (one-to-many, since a user can have many attendance records)
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'studentid');
    }
    public function student()
    {
        return $this->belongsToMany(ClassModel::class, 'class_student', 'studentid', 'classid');
    }
    public function classes() // relation for teachers
    {
        return $this->hasMany(ClassModel::class, 'teacherid'); // 'teacher_id' should be the foreign key in the 'classes' table.
    }
    protected static function boot()
    {
        parent::boot();

        // Hashing password automatically when creating/updating a user
        static::creating(function ($user) {
            if ($user->password) {
                $user->password = bcrypt($user->password);
            }
        });
    }
}
