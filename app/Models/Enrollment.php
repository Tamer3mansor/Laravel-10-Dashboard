<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
        
    protected $fillable = ['student_id', 'class_id', 'enrolled_at'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function class()
    {
        return $this->belongsTo(Classe::class);
    }
}
