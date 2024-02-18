<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $table = 'payrolls';
    protected $guarded = [
        'id'
    ];

    public function pegawai(){
        return $this->belongsTo(Employee::class,'id_pegawai','id');
    }

    public function setAlpha($value) {
        $this->attributes['alpha'] = json_encode($value);
    }
}
