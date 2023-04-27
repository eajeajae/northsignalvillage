<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangayid extends Model
{
    use HasFactory;
    protected $table = 'barangayids';
    protected $fillable = [
        'firstname',
        'middlename',
        'surname',
        'suffix',
        'birthdate',
        'contactno',
        'address',
        'precintNo',
        'contactperson',
        'guardianContact',
        'guardianAddress', 
        'typeofrequest_id',
        'user_id'
    ];

    public function user(){
        return $this->hasOne('App\Models\User', 'user_id', 'id');
    }
    public function typeofrequest(){
      return $this->belongsTo('App\Models\Typeofrequest', 'typeofrequest_id', 'id');
    }
    public function myrequests(){
        return $this->hasMany('App\Models\Myrequest', 'barangayid_id', 'id');
    }

}
