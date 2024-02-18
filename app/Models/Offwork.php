<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offwork extends Model
{
    use HasFactory;

    // protected $table = 'offworks';
    protected $fillable = [
        'user_id',
        'jenis_cuti',
        'foto',
        'alasan',
        'status',
        'waktu_pengajuan',
        'waktu_selesai',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    } 
}
