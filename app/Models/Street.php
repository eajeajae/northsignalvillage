<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    use HasFactory;

    protected $table = 'streets';
    protected $fillable = [
        'street'
    
    ];


    public function certificate(){
        return $this->belongsTo(Resident::class);
    }
}
