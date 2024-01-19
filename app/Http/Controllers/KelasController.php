<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function list(){

        $kelasList = Kelas::all(['_id', 'nama', 'total']);
        return response()->json($kelasList);
    }

    public function detail(String $id){

        $kelasDetail = Kelas::find($id);

        if (!$kelasDetail) {
            return response()->json(['Error' => 'Entry not found'], 404);
        }

        return response()->json($kelasDetail);
    }

    public function store(Request $request){

        $request->validate([
            'nama' => 'required',
            'total' => 'required',
            'murid' => 'required|array',
        ]);

        $kelas = new Kelas;

        $kelas->nama = $request->nama;
        $kelas->total = $request->total;
        $kelas->murid = $request->murid;
        $kelas->save();

        return response()->json(["Result" => "Success"], 201);
    }

    public function update(Request $request, $id){

        $kelas = Kelas::find($id);

        if (!$kelas) {
            return response()->json(['error' => 'Entry not found'], 404);
        }

        $request->validate([
            'nama' => 'required',
            'total' => 'required',
            'murid' => 'required|array',
        ]);

        $kelas->update($request->all());

        return response()->json(["Result" => "Success"], 200);
    }

}
