<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dinas extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'dinas';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function dinas_lampiran()
    {
        return $this->hasMany(DinasLampiran::class, 'dinas_id', 'id');
    }

    public function scopeFilter($query, $params)
    {
        if (@$params['search']) {
            $query->whereHas('user', function ($query) use ($params) {
                $query->where('name', 'like', '%' . $params['search'] . '%');
            });
        } 
        
          if (@$params['tanggal']) {
            $tanggal = explode(' - ', $params['tanggal']);
            $query->whereBetween('created_at', [$tanggal[0], $tanggal[1]]);
        }
    }
}
