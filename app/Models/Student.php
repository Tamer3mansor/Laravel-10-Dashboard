<?php
namespace App\Models;

use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
            
    use Translatable;

    public $translatedAttributes = ['name'];
    protected $fillable = ['guardian_id', 'birth_date'];

    public function guardian()
    {
        return $this->belongsTo(Guardian::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
