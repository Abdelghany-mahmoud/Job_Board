<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'user_id',
        'category_id',
        'description',
        'requirements',
        'responsibilities',
        'benefits',
        'location',
        'work_type',
        'min_salary',
        'max_salary',
        'application_deadline',
    ];
    function user()
    {
        return $this->belongsTo(User::class);
    }

    function category()
    {
        return $this->belongsTo(Category::class);
    }

    // function technologies()
    // {
    //     return $this->hasMany(Technology::class);
    // }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class, 'technologies_posts', 'post_id', 'technology_id');
    }
    public function applications()
    {
        return $this->hasMany(Application::class);
    }
};
