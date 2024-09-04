<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technologies_post extends Model
{
    use HasFactory;
    protected $fillable = [
        'post_id',
        'technology_id'
    ];

    function post()
    {
        return $this->hasMany(Post::class);
    }
    function technology()
    {
        return $this->belongsTo(Technology::class);
    }
}
