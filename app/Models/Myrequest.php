<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Myrequest extends Model
{
    use HasFactory;
    protected $table ='myrequests';
    protected $fillable = [
        'myrequestId',
        'typeofrequest_id', 
        'user_id'
    ];

    public function typeofrequest(){
        return $this->belongsTo('App\Models\Typeofrequest', 'typeofrequest_id', 'id');
    }
    public function users(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    public function barangayid(){
        return $this->belongsTo('App\Models\Barangayid', 'barangayid_id');
    }
    public function requestdocuments(){
        return $this->hasMany('App\Models\Requestdocument', 'myrequest_id');
    }
}
