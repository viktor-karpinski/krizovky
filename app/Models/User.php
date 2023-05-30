<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function likes()
    {
        $likes = 0;
        foreach ($this->hasMany(Game::class)->get() as $game) {
            $likes += $game->likes;
        }
        return $likes;
    }

    public function plays()
    {
        $plays = 0;
        foreach ($this->hasMany(Game::class)->get() as $game) {
            $plays += $game->plays;
        }
        return $plays;
    }

    public function liked()
    {
        return count($this->hasMany(GameLikes::class)->get());
    }

    public function completed()
    {
        return count($this->hasMany(GameCompletion::class)->get());
    }
}
