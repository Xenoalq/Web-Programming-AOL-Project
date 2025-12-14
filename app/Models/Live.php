<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Live extends Model
{
    //
    protected $primaryKey = 'live_id';

    protected $fillable = [
        'live_title', 'live_artist', 'stream_url'
    ];
}
