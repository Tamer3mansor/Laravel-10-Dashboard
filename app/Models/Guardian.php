<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Guardian  extends Model
{
        

    use Notifiable;

    protected $guard = 'guardian';

    protected $fillable = ['name', 'email', 'phone', 'password'];

    protected $hidden = ['password', 'remember_token'];

    public function students()
    {
        return $this->hasmany(Student::class);
    }
}
