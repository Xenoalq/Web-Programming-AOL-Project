<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Specify the custom primary key defined in the migration.
     */
    protected $primaryKey = 'users_id'; // IMPORTANT: Use your custom PK

    /**
     * The attributes that are mass assignable.
     * Mapped to the custom column names.
     */
    protected $fillable = [
        'users_name',   // Corresponds to users_name in DB
        'users_email',  // Corresponds to users_email in DB
        'users_pass',   // Corresponds to users_pass in DB
        'users_role',   // CRUCIAL: For Admin/User differentiation
    ];

    /**
     * The attributes that should be hidden for serialization.
     * Mapped to the custom column names.
     */
    protected $hidden = [
        'users_pass',       // Changed from 'password'
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'users_pass' => 'hashed', // Changed from 'password' to 'users_pass'
        ];
    }
}