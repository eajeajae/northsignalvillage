<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedulevaccine extends Model
{
    use HasFactory;
    protected $table = 'schedulevaccines';
    protected $fillable = [
        'name',
        'contact_num',
        'vaccine_id',
        'vaccine',
        'date',
        'time',
        'addressNo',
        'street',
        'email',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function vaccine(){
      return $this->belongsTo('App\Models\Vaccine', 'vaccine_id', 'id');
    }
}
