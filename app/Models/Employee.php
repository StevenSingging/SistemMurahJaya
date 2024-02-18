<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'nik',
        'nama',
        'tempat_lahir',
        'tgl_lahir',
        'jenis_kelamin',
        'alamat',
        'agama',
        'nip',
        'foto',
        'status_pegawai',
        'norek',
        'nama_rek',
        'no_hp',
        'id_bagian',
        'tgl_masuk',
    ];

    public function user(){
        return $this->hasOne(User::class,'employee_id','id');
    }

    public function bagian(){
        return $this->belongsTo(Position::class,'id_bagian');
    }

}
