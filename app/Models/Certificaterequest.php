<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificaterequest extends Model
{
    use HasFactory;
    protected $table = 'certificaterequests';
    protected $fillable = [
        'user_id', 
        'typeofrequest_id',
        'certificate_id',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function typeofrequest(){
      return $this->belongsTo('App\Models\Typeofrequest', 'typeofrequest_id', 'id');
    }
    public function certificate(){
      return $this->belongsTo('App\Models\Certificate');
    }
    // public function typeofrequest(){
    //     return $this->belongsToMany('App\Models\Typeofrequest', 'certificaterequests', 'user_id', 'typeofrequest_id');
    // }
}
