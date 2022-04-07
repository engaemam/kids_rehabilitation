<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Sub extends Authenticatable
{
    
    use Notifiable;
    protected $table='subs';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'password','address','name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



}