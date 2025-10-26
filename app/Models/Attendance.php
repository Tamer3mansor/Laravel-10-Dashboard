<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
        

    protected $fillable = [
        'teacher_id', 'student_id', 'date',
        'check_in', 'check_out', 'status'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
