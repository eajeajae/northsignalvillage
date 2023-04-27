<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clearancerequest extends Model
{
    use HasFactory;
    protected $table = 'clearancerequests';
    protected $fillable = [
        'user_id', 
        'typeofrequest_id',
        'clearance_id',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function clearance(){
        return $this->belongsTo('App\Models\Clearance', 'clearance_id', 'id');
    }
    public function typeofrequest(){
      return $this->belongsTo('App\Models\Typeofrequest', 'typeofrequest_id', 'id');
    }
    // public function typeofrequest(){
    //     return $this->belongsToMany('App\Models\Typeofrequest', 'clearancerequests', 'clearance_id', 'typeofrequest_id');
    // }
}
