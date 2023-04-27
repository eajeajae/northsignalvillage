<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $table = 'complaints';
    protected $fillable = [
        'complainantName', 
        'complainantAdress',
        'respondentName',
        'respondentAge', 
        'respondentAddress', 
        'complaintDesc', 
        'complaintLocation', 
        'complaintWhy', 
        'complainantPrayer', 
        'complaintDate',
        'complainantAgrees',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function mediationSchedule(){
      return $this->hasOne('App\Models\Mediation', 'complaint_id', 'id');
    }

}
