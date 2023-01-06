<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
//        'name',
//        'last_name',
//        'address',
        'email',
        'password',
        'user',
//        'group',
//        'class',
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

    public function getFirstNameAttribute()
    {
        $first_name = DB::table('user_data')->where('id', \auth()->user()->user)->value('first_name');
        return $first_name;
    }

    public function getLastNameAttribute()
    {
        $last_name = DB::table('user_data')->where('id', \auth()->user()->user)->value('last_name');
        return $last_name;
    }
}
