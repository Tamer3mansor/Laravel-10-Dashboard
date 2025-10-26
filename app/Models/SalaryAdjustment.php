<?php
namespace App\Models;

use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Model;

class SalaryAdjustment extends Model
{
   
    use Translatable;

    public $translatedAttributes = ['reason'];

    protected $fillable = [
        'teacher_id', 'type', 'amount', 'date'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
