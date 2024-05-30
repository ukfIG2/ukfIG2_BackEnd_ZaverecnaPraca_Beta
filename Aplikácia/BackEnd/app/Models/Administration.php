<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Administration extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $fillable = ['login', 'password', 'comment'];

    protected $hidden = ['password'];
}
