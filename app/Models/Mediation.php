<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mediation extends Model
{
    use HasFactory;
    protected $table = 'mediations';
    protected $fillable = [
        'user_id', 
        'complaint_id',
        'mediationSchedule',
    ];

    public function complaint(){
      return $this->belongsTo('App\Models\Complaint', 'complaint_id', 'id');
    }
}
