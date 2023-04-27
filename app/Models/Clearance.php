<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clearance extends Model
{
    use HasFactory;

    protected $table = 'clearances';
    protected $fillable = [
        'businessName',
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
        'businessAddress',
        'provincialAddress',
        'yearLiving',
        'areYouSure',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function clearancerequests(){
        return $this->hasMany('App\Models\Clearancerequest', 'clearance_id', 'typeofrequest_id');
    }
    public function typeofrequest(){
        return $this->hasMany('App\Models\Typeofrequest', 'typeofrequest_id', 'id');
    }
}
