<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserLogin extends Authenticatable
{
    protected $table = 'user_login';

    protected $casts = [
        'kelompok' => 'array', // Will convarted to (Array)
    ];

}
