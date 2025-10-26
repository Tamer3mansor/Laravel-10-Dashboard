<?php
namespace App\Models;

use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use Translatable;   
     


    public $translatedAttributes = ['name'];
    protected $fillable = ['teacher_id'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
