<?php

namespace App\Http\Controllers;

use App\Models\Murid;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MuridController extends Controller
{
    public function list(){

        $murid = Murid::all(['_id','nama','tanggal_lahir','alamat']);
        return response()->json($murid);
    }

    public function detail(String $id){

        $murid = Murid::find($id);

        if (!$murid) {
            return response()->json(['error' => 'Fatal Error'], 404);
        }

        $additionalData = Nilai::where('murid_id', $id)->get();

        $nilaiByMapel = $additionalData->groupBy('mata_pelajaran')->map(function ($group) {
            $nilailatihanSoal = $group->sum(function($nilai){
                return array_sum($nilai->nilai_latihan_soal) / 4;
            });
            $nilaiUlanganHarian = $group->sum(function($nilai){
                return array_sum($nilai->nilai_ulangan_harian) / 2;
            });
            $nilaiUts = $group->pluck('nilai_uas')->first() * (25/100);
            $nilaiUas = $group->pluck('nilai_uas')->first() * (40/100);
            $nilaiAkhir = ($nilailatihanSoal * (15/100)) + ($nilaiUlanganHarian * (20/100)) + $nilaiUts + $nilaiUas;

            return [
                'Nilai Akhir' => $nilaiAkhir
            ];
        });

        $result = [
            'Data Detail Murid' => $murid,
            'Nilai Mata Pelajaran' => $nilaiByMapel,
        ];

        $murid = $murid = Murid::all();

        return response()->json($result);
    }

    public function store(Request $request){

        $request->validate([
            'nama' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'nama_ortu' => 'required|array',
        ]);

        $murid = new Murid;

        $murid->nama = $request->nama;
        $murid->tanggal_lahir = $request->tanggal_lahir;
        $murid->alamat = $request->alamat;
        $murid->nama_ortu = $request->nama_ortu;
        $murid->save();

        return response()->json(["Result" => "Success"], 201);
    }
}
