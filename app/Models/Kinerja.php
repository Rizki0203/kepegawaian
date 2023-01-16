<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kinerja extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'kinerja';

    public function tugas()
    {
        return $this->belongsTo(Tugas::class, 'tugas_id');
    }

    public function scopeFilter($query, $params)
    {
        if (@$params['search']) {
            $query->whereHas('tugas', function ($q) use ($params) {
                $q->whereHas('user', function ($q) use ($params) {
                    $q->where('name', 'like', '%' . $params['search'] . '%');
                });
            });
        } 
        
          if (@$params['tanggal']) {
            $tanggal = explode(' - ', $params['tanggal']);
            $query->whereBetween('created_at', [$tanggal[0], $tanggal[1]]);
        }
    }

   
}
