<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;


class TanggapanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'foto' => 'required|image'
        ]);

        DB::table('pengaduan')->where('id', $request->pengaduan_id)->update([
            'status'=> $request->status,
        ]);
        
        $path_file = '/storage/tanggapan/';
        $nama_file = 'tanggapan-' . Str::random(20) . '.' . $request->file('foto')->clientExtension();
        $request->file('foto')->move(public_path($path_file), $nama_file);

        Alert::success('Berhasil', 'Pengaduan berhasil ditanggapi');
        Tanggapan::create([
            'pengaduan_id' => $request->pengaduan_id,
            'petugas_id' => Auth::user()->id,
            'tanggapan' => $request->tanggapan,
            'path_foto' => $path_file . $nama_file,
        ]);
        return redirect('admin/pengaduans');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Pengaduan::with([
            'details', 'user', 'tanggapan'
        ])->findOrFail($id);
        // dd($item);

        return view('pages.admin.tanggapan.add',[
            'item' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
