<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    
    use HasFactory;

 
    protected $guard = 'teacher';

    protected $fillable = [
        'name', 'email', 'phone', 'address', 'base_salary', 'password',
    ];

    protected $hidden = ['password', 'remember_token'];



    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function classes()
    {
        return $this->hasMany(Classe::class);
    }

    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }

    public function adjustments()
    {
        return $this->hasMany(SalaryAdjustment::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
