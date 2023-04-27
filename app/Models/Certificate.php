<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $table = 'certificates';
    protected $fillable = [
        'typeofDoc', 
        'purpose',
        'isRegistered', 
        'havePendingCase', 
        'name', 
        'gender', 
        'birthdate', 
        'p_birth', 
        'nationality',
        'contact_num',
        'c_status',
        'address',
        'provincialAddress',
        'yearLiving',
        'areYouSure'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function typeofrequest(){
      return $this->belongsTo('App\Models\Typeofrequest', 'typeofrequest_id', 'id');
    }
}
