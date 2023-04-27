<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filledcomplaint extends Model
{
    use HasFactory;
    protected $table = 'filledcomplaints';
    protected $fillable = [
        'user_id', 
        'typeofrequest_id',
        'complaint_id',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function typeofrequest(){
        return $this->belongsToMany('App\Models\Typeofrequest', 'filledcomplaints', 'user_id', 'typeofrequest_id');
    }
}
