<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Murid extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'Murid';
    protected $fillable = ['nama', 'tanggal_lahir', 'alamat','nama_ortu'];

    protected $dates = ['tanggal_lahir'];

    public function nilaiSiswa()
    {
        return $this->hasMany(Nilai::class, 'murid_id');
    }
}
