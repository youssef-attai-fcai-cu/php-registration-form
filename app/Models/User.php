<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'full_name',
        'username',
        'email',
        'password',
        'birthdate',
        'phone',
        'address',
    ];

    use HasFactory;
}
