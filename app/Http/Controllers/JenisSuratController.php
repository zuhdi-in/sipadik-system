<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use Illuminate\Http\Request;

class JenisSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = JenisSurat::all();
        return view('dashboard.jenis-surat.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.jenis-surat.add-jenis-surat');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_jenis' => 'required|string|max:255',
        ]);

        JenisSurat::create($validatedData);

        return redirect()->route('jenis-surat.index')
            ->with('status', 'Data Jenis Surat Baru Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $row = JenisSurat::find($id);
        return view('dashboard.jenis-surat.edit-jenis-surat', compact('row'));
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
        //proses input pegawai
        $updatedData = $request->validate([
            'nama_jenis' => 'required|string|max:255',
        ]);

        //lakukan update data dari request form edit
        JenisSurat::find($id)->update($updatedData);

        return redirect()->route('jenis-surat.index')
            ->with('success', 'Data Jenis Surat Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        JenisSurat::where('id', $id)->delete();
        return redirect()->route('jenis-surat.index')
            ->with('status', 'Data Jenis Surat Berhasil Dihapus');
    }
}

