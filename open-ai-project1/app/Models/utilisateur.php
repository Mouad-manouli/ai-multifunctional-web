<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class utilisateur extends Authenticatable
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'password','provider','provider_id','provider_token'];
}
