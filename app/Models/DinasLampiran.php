<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DinasLampiran extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'dinas_lampiran';

    public function dinas()
    {
        return $this->belongsTo(Dinas::class);
    }
}
