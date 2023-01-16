<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'tugas';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function kinerja()
    {
        return $this->hasMany(Kinerja::class, 'tugas_id');
    }

    public function scopeFilter($query, $params)
    {
        if (@$params['search']) {
            $query->where('tugas', 'like', "%{$params['search']}%")
                ->orWhereHas('user', function ($query) use ($params) {
                    $query->where('name', 'like', "%{$params['search']}%");
                });
        } 

         if (@$params['tanggal']) {
            $tanggal = explode(' - ', $params['tanggal']);
            $query->whereBetween('created_at', [$tanggal[0], $tanggal[1]]);
        }
    
    }

     public function getSisaHariAttribute()
    {
        $this->mulai = \Carbon\Carbon::parse($this->mulai);
        $this->berakhir = \Carbon\Carbon::parse($this->berakhir);

        $total_hari = $this->mulai->diffInDays($this->berakhir);

        // return ... bulan ... tahun
        $years = floor($total_hari / 365);
        $months = floor(($total_hari - ($years * 365)) / 30);
        $days = floor($total_hari % 30);

        // if tahun is 0 then remove tahun
        if ($years == 0) {
            $years = '';
        } else {
            $years = $years . ' tahun ';
        }

        if ($months == 0) {
            $months = '';
        } else {
            $months = $months . ' bulan ';
        }

        return $years . $months . $days . ' hari';
    }

    public function getStatusCompleteAttribute()
    {
        // if is complete 0 then return Belum Selesai, else selesai
        if ($this->is_complete == 0) {
            return '<span class="badge bg-danger">Belum Selesai</span>';
        } else {
            return '<span class="badge bg-success">Selesai</span>';
        }
    }
}
