<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'Nilai';
    protected $fillable = ['murid_id','mata_pelajaran','nilai_latihan_soal','nilai_ulangan_harian','nilai_uts','nilai_uas'];

    public function murid()
    {
        return $this->belongsTo(Murid::class, 'murid_id');
    }
}
