<?php

namespace Modules\Authentication\App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;
class ComUser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UuidTrait, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'firstname',
        'lastname',
        'birthplace',
        'birthdate',
        'gender',
        'avatar',
        'phone',
        'address',
        'email_verified_at',
        'is_active',
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
        'password' => 'hashed',
    ];

    protected function avatarUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->avatar && file_exists($this->avatar)) {
                    return asset($this->avatar);
                }
        
                if ($this->avatar == null && $this->gender == "l") {
                    return asset('assets/images/avatars/blank-avatar-man.jpg');
                }
                
                if ($this->avatar == null && $this->gender == "p") {
                    return asset('assets/images/avatars/blank-avatar-woman.jpg');
                }
                
                return asset('assets/images/avatars/blank-avatar.png');
            }
        );
    }
    
    protected function fullname(): Attribute
    {
        return Attribute::make(
            get: fn() => trim($this->firstname . ' ' . $this->lastname)
        );
    }

    protected function mainRole(): Attribute
    {
        return Attribute::make(
            get: fn() => Str::ucfirst($this->roles()->first()?->name)
        );
    }
}
