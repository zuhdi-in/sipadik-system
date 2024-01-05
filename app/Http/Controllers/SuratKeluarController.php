<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class SuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('surat_keluar')
                    ->join('jenis_surat', 'surat_keluar.jenis_surat_id', '=', 'jenis_surat.id')
                    ->select('surat_keluar.*', 'jenis_surat.nama_jenis')
                    ->get();
        return view('dashboard.surat-keluar.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis = JenisSurat::all();
        return view('dashboard.surat-keluar.add-surat-keluar', compact('jenis'));
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
            'nomor_surat' => 'required|string|unique:surat_keluar',
            'perihal' => 'required|string',
            'tanggal_keluar' => 'required|date',
            'penerima' => 'required|string',
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

            SuratKeluar::create($data);

            return redirect()->route('surat-keluar.index')
                ->with('status', 'Data Surat Keluar Baru Berhasil Disimpan');
        }

        return back()->with('status', 'File tidak diunggah atau tidak valid');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function show(SuratKeluar $suratKeluar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = SuratKeluar::find($id);
        $jenis = JenisSurat::all();
        return view('dashboard.surat-keluar.edit-surat-keluar', compact('data','jenis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //proses input pegawai
        $request->validate([
            'nomor_surat' => 'required|string',
            'perihal' => 'required|string',
            'tanggal_keluar' => 'required|date',
            'penerima' => 'required|string',
            'berkas' => 'file|max:2048', // Max file size is 2MB (2048 KB)
            'keterangan' => 'string',
            'jenis_surat_id' => '',
        ]);

        $suratKeluar = SuratKeluar::find($id);

        if (!$suratKeluar) {
            return back()->with('status', 'Data not found');
        }

        $data = $request->except('berkas');

        if ($request->hasFile('berkas') && $request->file('berkas')->isValid()) {
            $file = $request->file('berkas');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);

            $data['berkas'] = 'uploads/' . $fileName;
        }

        $suratKeluar->update($data);

        return redirect()->route('surat-keluar.index')
            ->with('status', 'Data Surat Keluar Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SuratKeluar::where('id', $id)->delete();
        return redirect()->route('surat-keluar.index')
            ->with('status', 'Data Surat Keluar Berhasil Dihapus');
    }

    public function exportPDF()
    {
        $data = DB::table('surat_keluar')
        ->join('jenis_surat', 'surat_keluar.jenis_surat_id', '=', 'jenis_surat.id')
        ->select('surat_keluar.nomor_surat','surat_keluar.perihal','surat_keluar.tanggal_keluar','surat_keluar.penerima','surat_keluar.keterangan', 'jenis_surat.nama_jenis')
        ->get();
        $pdf = PDF::loadView('dashboard.surat-keluar.exportPDF', ['data' => $data])->setPaper('a4', 'landscape');
        $dateTime = now()->format('Y-m-d_H-i-s'); // Current date and time formatted
        $pdfFileName = 'suratKeluar_' . $dateTime . '.pdf'; // Constructing the PDF file name

        // Return the PDF as a response
        return $pdf->stream($pdfFileName);
    }

    public function exportExcel()
    {
        $data = DB::table('surat_keluar')
        ->join('jenis_surat', 'surat_keluar.jenis_surat_id', '=', 'jenis_surat.id')
        ->select('surat_keluar.nomor_surat','surat_keluar.perihal','surat_keluar.tanggal_keluar','surat_keluar.penerima','surat_keluar.keterangan', 'jenis_surat.nama_jenis')
        ->get();

        if ($data->isEmpty()) {            
            return redirect()->route('surat-keluar.index')
                ->with('status', 'No data available for export');
        }
        $dateTime = now()->format('Y-m-d_H-i-s'); // Current date and time formatted
        $fileName = 'suratKeluar_' . $dateTime . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=' . $fileName,
        ];

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');

            // Header row
            fputcsv($file, array_keys((array) $data[0]));

            // Data rows
            foreach ($data as $row) {
                fputcsv($file, (array) $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function downloadFile($id)
    {
        $file = DB::table('surat_keluar')
            ->select('berkas')
            ->where('id', $id)
            ->first();

        if (!$file) {
            return redirect()->route('surat-keluar.index')
                ->with('status', 'File not found');
        }

        $filePath = public_path($file->berkas);
        
        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return redirect()->route('surat-keluar.index')
                ->with('status', 'File not found');
        }
    }

    public function previewFile($id)
    {
        $file = DB::table('surat_keluar')
            ->select('berkas')
            ->where('id', $id)
            ->first();

        if (!$file) {
            return redirect()->route('surat-keluar.index')
                ->with('status', 'File not found');
        }

        $filePath = public_path($file->berkas);

        if (file_exists($filePath)) {
            return response()->file($filePath);
        } else {
            return redirect()->route('surat-keluar.index')
                ->with('status', 'File not found');
        }
    }
}
