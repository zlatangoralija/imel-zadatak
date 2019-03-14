<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'photo_id', 'is_active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    //Kreiranje relacije user->role
    public function role(){
        return $this->belongsTo('App\Role');
    }
    //Kreiranje relacije user->photo
    public function photo(){
        return $this->belongsTo('App\Photo', 'photo_id');
    }
    //Provjera da li user posjeduje role admin. Ako user nije admin, ne može pristupidi /admin panelu
    public function isAdmin(){
        if ($this->role->name == "admin" && $this->is_active == 1){
            return true;
        }
        return false;
    }
    //Relacija user->posts
    public function posts(){
        return $this->hasMany('App\Post');
    }
}
