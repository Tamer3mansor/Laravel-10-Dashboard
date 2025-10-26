<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
            
    protected $fillable = [
        'teacher_id', 'base_salary', 'net_salary', 'month'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
