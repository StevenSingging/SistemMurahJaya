<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    // protected $fillable = [
    //     'nama_jabatan',
    //     'gaji_pokok',
    //     'tunjangan',
    // ];
    protected $table = 'positions';
    protected $guarded = [
        'id'
    ];
    
}
