<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nidn',
        'name',
        'email',
        'password',
        'role',
        'image',
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

    public function cutis()
    {
        return $this->hasMany(Cuti::class, 'user_id', 'id');
    }

    public function kontraks()
    {
        return $this->hasMany(Kontrak::class, 'user_id', 'id');
    }

    public function dinas()
    {
        return $this->hasMany(Dinas::class, 'user_id', 'id');
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class, 'user_id', 'id');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    public function getAvatarAttribute()
    {
        // if photo is null return default image
        if ($this->attributes['image'] == null) {
            return asset('assets/img/avatars/avatar.jpg');
        } else {
            // if photo is not found return default image
            if (!Storage::disk('public')->exists($this->attributes['image'])) {
                return asset('assets/img/avatars/avatar.jpg');
            } else {
                // return photo
                return asset('storage/' . $this->attributes['image']);
            }
        }
        // return photo url
        return asset('storage/' . $this->attributes['image']);
        return $this->attributes['image'] ? asset('storage' . $this->attributes['image']) : asset('');
    }

    public function scopeFilter($query, $params)
    {
        if (@$params['search']) {
            $query->where('name', 'like', '%' . $params['search'] . '%')->orWhere('email', 'like', '%' . $params['search'] . '%');
        } 
    }

    public function getJabatanAttribute()
    {
        if ($this->attributes['role'] == 'user') {
            return 'Karyawan';
        } else {
            return 'Admin';
        }

    }
}
