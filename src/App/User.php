<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * Retrieves user's full name
     *
     * @return string
     */
    public function getFullName(  ){
        
        return $this->firstname.' '.$this->lastname;
    }

    /**
     * Check whether the user is an admin
     *
     * @return boolean
     */
    public function isAdmin(  ){
        
        if(Auth::user()->id != 1)
            return false;

        return true;
    }
}
