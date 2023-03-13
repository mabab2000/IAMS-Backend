<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function hasRole($roleName)
    {
        return $this->roles()->where('name', $roleName)->exists();
    }
    use HasApiTokens, HasFactory, Notifiable,HasRoles;
 protected static function booted()
    {
        static::created(function ($user) {
            $user->roles()->attach(Role::where('name', 'student')->first(), ['user_id' => $user->id]);
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
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
// User model

  
  // Define hasRole method
  public function can($ability, $arguments = [])
  {
      if ($this->hasRole('admin')) {
          return true;
      }

      return parent::can($ability, $arguments);
  }
  
}
