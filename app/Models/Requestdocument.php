<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requestdocument extends Model
{
    use HasFactory;
    public function userRequests(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function myrequests(){
        return $this->belongsTo('App\Models\Myrequest', 'myrequest_id');
    }
}
