<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class MTantWeb extends Authenticatable
{
    use Notifiable;

    public $incrementing = false;
    protected $table = "M_TANT_WEB";
    protected $guard = 'm_tant_web';
    protected $primaryKey = 'TANT_CD';
    const CREATED_AT = 'ADD_YMD';
    const UPDATED_AT = 'UPD_YMD';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'TANT_CD', 'PASSWORD', 'DEL_FLG',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'PASSWORD'
    ];

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->PASSWORD;
    }
    public function getPasswordAttribute($value)
    {
        if( \Hash::needsRehash($value) ) {
            $value = \Hash::make($value);
        }

        return  $value;
    }
    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['PASSWORD'] = $value;
        }
    }
}
