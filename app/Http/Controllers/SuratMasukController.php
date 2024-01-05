<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use App\Models\SuratMasuk;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('surat_masuk')
                    ->join('jenis_surat', 'surat_masuk.jenis_surat_id', '=', 'jenis_surat.id')
                    ->select('surat_masuk.*', 'jenis_surat.nama_jenis')
                    ->get();
        return view('dashboard.surat-masuk.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis = JenisSurat::all();
        return view('dashboard.surat-masuk.add-surat-masuk', compact('jenis'));
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
            'nomor_surat' => 'required|string|unique:surat_masuk',
            'perihal' => 'required|string',
            'tanggal_surat' => 'required|date',
            'pengirim' => 'required|string',
            'tanggal_diterima' => 'required|string',
            'disposisi' => 'required|string',
            'berkas' => 'required|file|max:2048', // Max file size is 2MB (2048 KB)
            'keterangan' => 'required|string',
            'jenis_surat_id' => 'required|string',
        ]);

        if ($request->hasFile('berkas') && $request->file('berkas')->isValid()) {
            $file = $request->file('berkas');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);

            $data = $request->except('berkas');
            $data['berkas'] = 'uploads/' . $fileName;

            SuratMasuk::create($data);

            return redirect()->route('surat-masuk.index')
                ->with('status', 'Data Surat Masuk Baru Berhasil Disimpan');
        }
        

        return back()->with('status', 'File tidak diunggah atau tidak valid');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function show(SuratMasuk $suratMasuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = SuratMasuk::find($id);
        $jenis = JenisSurat::all();
        return view('dashboard.surat-masuk.edit-surat-masuk', compact('data','jenis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //proses input pegawai
        $request->validate([
            'nomor_surat' => 'required|string',
            'perihal' => 'required|string',
            'tanggal_surat' => 'required|date',
            'pengirim' => 'required|string',
            'tanggal_diterima' => 'required|string',
            'disposisi' => 'required|string',
            'berkas' => 'file|max:2048', // Max file size is 2MB (2048 KB)
            'keterangan' => 'required|string',
            'jenis_surat_id' => 'string',
        ]);

        $suratMasuk = SuratMasuk::find($id);

        if (!$suratMasuk) {
            return back()->with('status', 'Data not found');
        }

        $data = $request->except('berkas');

        if ($request->hasFile('berkas') && $request->file('berkas')->isValid()) {
            $file = $request->file('berkas');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);

            $data['berkas'] = 'uploads/' . $fileName;
        }

        $suratMasuk->update($data);

        return redirect()->route('surat-masuk.index')
            ->with('status', 'Data Surat Masuk Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SuratMasuk::where('id', $id)->delete();
        return redirect()->route('surat-masuk.index')
            ->with('status', 'Data Surat Masuk Berhasil Dihapus');
    }

    public function exportPDF()
    {
        $data = DB::table('surat_masuk')
                    ->join('jenis_surat', 'surat_masuk.jenis_surat_id', '=', 'jenis_surat.id')
                    ->select('surat_masuk.*', 'jenis_surat.nama_jenis')
                    ->get();
        $pdf = PDF::loadView('dashboard.surat-masuk.exportPDF', ['data' => $data])->setPaper('a4', 'landscape');
        $dateTime = now()->format('Y-m-d_H-i-s'); // Current date and time formatted
        $pdfFileName = 'suratMasuk_' . $dateTime . '.pdf'; // Constructing the PDF file name

        // Return the PDF as a response
        return $pdf->stream($pdfFileName);
    }

    public function exportExcel()
    {
        $users = DB::table('surat_masuk')
        ->join('jenis_surat', 'surat_masuk.jenis_surat_id', '=', 'jenis_surat.id')
        ->select('surat_masuk.nomor_surat','surat_masuk.perihal','surat_masuk.tanggal_surat','surat_masuk.pengirim','surat_masuk.tanggal_diterima','surat_masuk.disposisi','surat_masuk.berkas','surat_masuk.keterangan', 'jenis_surat.nama_jenis')
        ->get();

        if ($users->isEmpty()) {
            return redirect()->route('surat-masuk.index')
                ->with('status', 'File not found');
        }
        $dateTime = now()->format('Y-m-d_H-i-s'); // Current date and time formatted
        $fileName = 'suratMasuk_' . $dateTime . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=' . $fileName,
        ];

        $callback = function () use ($users) {
            $file = fopen('php://output', 'w');

            // Header row
            fputcsv($file, array_keys((array) $users[0]));

            // Data rows
            foreach ($users as $user) {
                fputcsv($file, (array) $user);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function downloadFile($id)
    {
        $file = DB::table('surat_masuk')
            ->select('berkas')
            ->where('id', $id)
            ->first();

        if (!$file) {
            return redirect()->route('surat-masuk.index')
                ->with('status', 'File not found');
        }

        $filePath = public_path($file->berkas);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return redirect()->route('surat-masuk.index')
                ->with('status', 'File not found');
        }
    }

    public function previewFile($id)
    {
        $file = DB::table('surat_masuk')
            ->select('berkas')
            ->where('id', $id)
            ->first();

        if (!$file) {
            return redirect()->route('surat-masuk.index')
                ->with('status', 'File not found');
        }

        $filePath = public_path($file->berkas);

        if (file_exists($filePath)) {
            return response()->file($filePath);
        } else {
            return redirect()->route('surat-masuk.index')
                ->with('status', 'File not found');
        }
    }
}
