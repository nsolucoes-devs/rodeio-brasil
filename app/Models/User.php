<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\Common;
use App\Traits\HasHashIds;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasHashIds, HasRoles, SoftDeletes, Common;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
        'email',
        'email_verified',
        'password',
        'picture',
        'document',
        'phone',
        'role',
        'user_terms_accepted_at',
        'user_full_registration',
        'user_responded_form',
        'active',
        'action'
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
            'user_terms_accepted_at' => 'date',
        ];
    }

    public static function boot(): void
    {
        parent::boot();
        static::created(function ($user) {
            $user->code = $user->hash();
            $user->save();
        });
    }

    protected function setNamelAttribute($name)
    {
        $this->attributes['name'] = ucfirst(mb_strtolower($name));
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function setEmailAttribute($email)
    {
        $this->attributes['email'] = mb_strtolower($email);
    }

    protected function slugify(string $name): string
    {
        return Str::slug($name);
    }
}
