<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typeofrequest extends Model
{
    use HasFactory;
    protected $table = 'typeofrequests';
    public $timestamps = false;
    protected $fillable = [
        'category', 
        'typeofdoc',
        'price'
    ];

    public function scopeCertificate($query){
        return $query->where('category', 'Certificates');
    }
    public function scopeBarangayid($query){
        return $query->where('category', 'Barangay ID');
    }
    public function scopeClearance($query){
        return $query->where('category', 'Clearances');
    }
    public function scopeComplaint($query){
        return $query->where('category', 'Complaint');
        
    }
    public function myrequests(){
        return $this->hasMany('App\Models\Myrequest', 'typeofrequest_id', 'user_id');
    }

    public function idRequest(){
        return $this->hasOne('App\Models\Barangayid', 'typeofrequest_id', 'id');
    }
    public function clearancerequest(){
        return $this->belongsToMany('App\Models\Typeofrequest', 'clearancerequests', 'user_id', 'typeofrequest_id');
    }
    public function certificaterequest(){
        return $this->belongsToMany('App\Models\Certificaterequest', 'typeofrequest_id', 'id');
    }
    // public function certificaterequest(){
    //   return $this->hasMany('App\Models\Typeofrequest', 'typeofrequest_id', 'id');
    // }
}
