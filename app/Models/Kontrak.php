<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontrak extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'kontrak';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeFilter($query, $params)
    {
        if (@$params['search']) {
            $query->whereHas('user', function ($query) use ($params) {
                $query->where('name', 'like', '%' . $params['search'] . '%');
            });
        } 
    }

    public function getTotalHariAttribute()
    {
        $this->mulai_kontrak = \Carbon\Carbon::parse($this->mulai_kontrak);
        $this->berakhir_kontrak = \Carbon\Carbon::parse($this->berakhir_kontrak);

        $total_hari = $this->mulai_kontrak->diffInDays($this->berakhir_kontrak);

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

        return $years . $months . ' bulan ' . $days . ' hari';
    }

}
