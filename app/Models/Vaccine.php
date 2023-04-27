<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
    use HasFactory;
    protected $table = 'vaccines';
    protected $fillable = [
        'name',
        'category',
        'stocks'
    ];

    public function schedulevaccine(){
        return $this->hasOne('App\Models\Vaccine', 'vaccine_id', 'id');
    }
}
