<?php

namespace App\Http\Controllers;

use App\Events\StatusAntrianUpdated;
use App\Models\Antrian;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
class AntrianController extends Controller
{
    public function index()
    {
        $antrians = Antrian::paginate(2);  // Atur pagination
        $totalAntrian = Antrian::count();
        $menunggu = Antrian::where('status', 'Menunggu')->count();
        $dilayani = Antrian::where('status', 'Dilayani')->count();
        $selesai = Antrian::where('status', 'Selesai')->count();

        return view('antrian.index', compact('antrians', 'totalAntrian', 'menunggu', 'dilayani', 'selesai'));
    }

    public function daftarAntrian()
    {
        $antrians = Antrian::all();
        return view('antrian.daftarAntrian', compact('antrians'));
    }


    public function destroy($id)
    {
        $antrian = Antrian::find($id);
        $antrian->delete();

        return redirect()->route('antrian.index')->with('success', 'Antrian berhasil dihapus');
    }

    public function create()
    {
        return view('antrian.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_antrian' => 'required|integer',
            'status' => 'required|in:Menunggu,Dilayani,Selesai',
        ]);

        Antrian::create([
            'nama' => $request->nama,
            'nomor_antrian' => $request->nomor_antrian,
            'status' => $request->status,
        ]);

        return redirect()->route('antrian.index')->with('success', 'Antrian berhasil ditambahkan.');
    }


    public function generateQrCode($id)
    {
        $antrian = Antrian::find($id);
        $qrcode = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)->generate($antrian->nomor_antrian);
        return view('antrian.qrcode', compact('qrcode'));
    }

    public function scan()
    {
        return view('antrian.scan');
    }


    public function show($id)
    {
        $antrian = Antrian::findOrFail($id);

        // Generate QR code untuk nomor antrian
        $qrcode = QrCode::size(200)->generate(route('antrian.show', $antrian->id));

        return view('antrian.show', compact('antrian', 'qrcode'));
    }

    public function updateStatus($id, $status)
    {
        $antrian = Antrian::find($id);
        $antrian->status = $status;
        $antrian->save();

        event(new StatusAntrianUpdated($antrian));

        return redirect()->route('antrian.index')->with('success', 'Status antrian berhasil diperbarui!');
    }



}
