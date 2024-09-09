<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Employer;
use App\Models\Admin;
use App\Models\Job_seeker;

class User extends Authenticatable
{
  use HasFactory, Notifiable;

  protected static function booted()
  {
    // Automatically add user to the corresponding table based on their role
    static::created(function ($user) {
      switch ($user->role) {
        case 'employer':
          Employer::create([
            'user_id' => $user->id,
            'company_name' => null, // Modify as needed
            'company_website' => null, // Modify as needed
          ]);
          break;

        case 'admin':
          Admin::create([
            'user_id' => $user->id,
            'profile_pic' => null, // Modify as needed
          ]);
          break;

        case 'job_seeker':
          Job_seeker::create([
            'user_id' => $user->id,
            'linkedin_profile' => null,
            'skills' => null,
            'phone' => null,
            'location' => null,
            'bio' => null,
            'profile_pic' => null,
          ]);
          break;

        default:
          break;
      }
    });
    static::updated(function ($user) {
      switch ($user->role) {
        case 'employer':
          Employer::where('user_id', $user->id)->update([
            'company_name' => $user->company_name,
            'company_website' => $user->company_website,
          ]);
          break;

        case 'admin':
          Admin::where('user_id', $user->id)->update([
            'profile_pic' => $user->profile_pic,
          ]);
          break;

        case 'job_seeker':
          Job_seeker::where('user_id', $user->id)->update([
            'linkedin_profile' => $user->linkedin_profile,
            'skills' => $user->skills,
            'phone' => $user->phone,
            'location' => $user->location,
            'bio' => $user->bio,
            'profile_pic' => $user->profile_pic,
          ]);
          break;

        default:
          break;
      }
    });
  }


  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
    'role'
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }
  public function application()
  {
    return $this->hasOne(Application::class);
  }
  public function job_seeker()
  {
    return $this->hasOne(Job_seeker::class);
  }

  public function posts()
  {
    return $this->hasMany(Post::class);
  }

  public function comments()
  {
    return $this->hasMany(Comment::class);
  }
  public function employer()
  {
    return $this->hasOne(Employer::class);
  }

  public function admin()
{
    return $this->hasOne(Admin::class, 'user_id', 'id');
}


  public function isEmployer()
  {
    return $this->role === 'employer';
  }

  public function isAdmin()
  {
    return $this->role === 'admin';
  }
}
