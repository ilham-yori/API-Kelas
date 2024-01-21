<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function list(){

        $kelasList = Kelas::all(['_id', 'nama', 'nama_wali']);
        return response()->json($kelasList);
    }

    public function detail(String $id){

        $kelasDetail = Kelas::find($id);

        if (!$kelasDetail) {
            return response()->json(['Error' => 'Fatal Error'], 404);
        }

        return response()->json($kelasDetail);
    }

    public function store(Request $request){

        $request->validate([
            'nama' => 'required',
            'nama_wali' => 'required',
            'murid' => 'required|array',
        ]);

        $kelas = new Kelas;

        $kelas->nama = $request->nama;
        $kelas->nama_wali = $request->nama_wali;
        $kelas->murid = $request->murid;
        $kelas->save();

        return response()->json(["Result" => "Success"], 201);
    }

    public function update(Request $request, $id){

        $kelas = Kelas::find($id);

        if (!$kelas) {
            return response()->json(['Error' => 'Fatal Error'], 404);
        }

        $request->validate([
            'nama' => 'required',
            'nama_wali' => 'required',
            'murid' => 'required|array',
        ]);

        $kelas->update($request->all());

        return response()->json(["Result" => "Success"], 200);
    }

}
