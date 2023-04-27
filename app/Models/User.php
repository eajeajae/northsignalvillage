<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Resident;
use App\Models\Donation;
use App\Models\Scholarship;
use App\Models\Certificate;
use App\Models\Clearance;
use App\Models\Complaint;
use App\Models\Announcement;
use App\Models\Employer;
use App\Models\Applicant;
use App\Models\Joboffer;
use App\Models\Barangayid;

class User extends Authenticatable 
{
    use HasApiTokens,HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'birthdate',
        'age', 
        'addressNo',
        'street',
        'addressZone',
        'phoneNum',
        'valid_id', 
        'avatar',
        'email',
        'password',
        'role',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function allmyrequests(){
      return $this->hasMany('App\Models\Requestdocument', 'user_id');
    }
    public function applicants(){
        return $this->hasMany('App\Models\Applicant', 'user_id');
    }
    public function announcements(){
        return $this->hasMany('App\Models\Announcement', 'user_id');
    }
    public function barangayids(){
        return $this->belongsTo('App\Models\Barangayid', 'user_id', 'id');
    }
    public function certificate(){
      return $this->hasMany('App\Models\Certificate', 'user_id', 'id');
    }
    public function clearance(){
      return $this->hasMany('App\Models\Clearance', 'user_id', 'id');
    }
    public function complaints(){
        return $this->hasMany('App\Models\Complaint', 'user_id');
    }
    public function donations(){
        return $this->hasMany('App\Models\Donation', 'user_id');
    }
    public function employers(){
        return $this->hasMany('App\Models\Employer', 'user_id');
    }
    public function joboffers(){
        return $this->hasMany('App\Models\Joboffer', 'user_id');
    }
    public function myrequests(){
        return $this->hasMany('App\Models\Myrequest', 'user_id');
    }
    public function schedulevaccines(){
        return $this->hasMany('App\Models\Schedulevaccine', 'user_id');
    }
    public function scholarships(){
        return $this->hasMany('App\Models\Scholarship', 'user_id');
    }
    public function scopeVerifiedResidents($query){
        return $query->where('status', 'verified');
    }
    public function scopeNotverifiedResidents($query){
        return $query->where('status', 'not verified');
    }
}
