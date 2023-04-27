<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    use HasFactory;

    protected $table = 'scholarships';
    protected $fillable = [
        'scholarshipID',
        'scholarFname',
        'scholarLname',
        'scholarPhonenum',
        'scholarAddress',
        'scholarSchool',
        'scholarCourse',
        'scholarEmail',
        'scholarCor_img',
        'scholarGrade_img'
    
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
