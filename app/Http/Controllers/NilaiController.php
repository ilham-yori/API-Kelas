<?php

namespace App\Http\Controllers;

use App\Models\Murid;
use App\Models\Nilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function showByMataPelajaran($mataPelajaran)
    {
        $nilaiData = Nilai::where('mata_pelajaran', $mataPelajaran)->get();

        if ($nilaiData->isEmpty()) {
            return response()->json(['Error' => 'Fatal Error'], 404);
        }

        $transformedData = $nilaiData->map(function ($nilai) {
            return [
                'murid_id' => $nilai->murid_id,
                'nilai_latihan_soal' => $nilai->nilai_latihan_soal,
                'nilai_ulangan_harian' => $nilai->nilai_ulangan_harian,
                'nilai_uts' => $nilai->nilai_uts,
                'nilai_uas' => $nilai->nilai_uas,
            ];
        });

        return response()->json($transformedData);
    }

    public function store(Request $request){
        $request->validate([
            'id' => 'required',
            'nilai_latihan_soal' => 'required',
            'nilai_ulangan_harian' => 'required',
            'nilai_uts' => 'required',
            'nilai_uas' => 'required',
            'mata_pelajaran' => 'required|string',
        ]);

        $murid = Murid::find($request->id);

        if (!$murid) {
            return response()->json(['Error' => 'Fatal Error'], 404);
        }

        $nilai = new Nilai;

        $nilai->murid_id = $request->id;
        $nilai->mata_pelajaran = $request->mata_pelajaran;
        $nilai->nilai_latihan_soal = $request->nilai_latihan_soal;
        $nilai->nilai_ulangan_harian = $request->nilai_ulangan_harian;
        $nilai->nilai_uts = $request->nilai_uts;
        $nilai->nilai_uas = $request->nilai_uas;

        $nilai->save();

        return response()->json(['Result' => 'Success'], 201);
    }
}
