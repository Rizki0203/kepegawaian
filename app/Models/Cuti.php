<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'cuti';

     public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getTotalCutiAttribute()
    {
        $this->mulai_cuti = \Carbon\Carbon::parse($this->mulai_cuti);
        $this->berakhir_cuti = \Carbon\Carbon::parse($this->berakhir_cuti);

        $total_hari = $this->mulai_cuti->diffInDays($this->berakhir_cuti);

        return $total_hari;
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
