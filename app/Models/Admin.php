<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $guard = 'admin';

    protected $guarded;

    public function role(){
        return $this->belongsTo(AdminRole::class,'admin_role_id');
    }
    public function getStudents(){
        return $this->hasMany(User::class,'user_id','id');
    }
}
