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
        'firstname', 'middlename', 'lastname', 'contact', 'email', 'password', 'newsletter'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    // Retrieves fullname
    public function getFullName()
    {
        return $this->firstname.' '.$this->middlename.' '.$this->lastname;
    }

    // Check for web administrator
    public function isAdmin()
    {
        if(Auth::user()->id != 1)
            return false;
        return true;
    }
}
