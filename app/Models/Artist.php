<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;
    
    // CRITICAL FIX 1: Set the custom table name to prevent the "no such table" error
    protected $table = 'artists'; // If your migration is 2025_11_25_184210_create_artists_table

    // CRITICAL FIX 2: Set the custom primary key
    protected $primaryKey = 'artist_id'; 
    
    // Disable timestamps if you didn't include them in the artists table
    // public $timestamps = false; 

    protected $fillable = [
        'artist_name',
    ];

    // You might also need a relationship if songs are accessed via artist
    public function songs()
    {
        return $this->hasMany(Song::class, 'artist_id', 'artist_id');
    }
}
