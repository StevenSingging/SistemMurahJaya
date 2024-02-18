<?php

namespace App\Http\Controllers;

use App\Models\Absent;
use App\Models\Offwork;
use App\Models\Payroll;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class KaryawanController extends Controller
{
    public function index()
    {
        $tahun      = date('Y');
        $bulan      = date('m');
        $hari       = date('d');
        $jamBukaAbsen = '08:30:00'; // Jam buka absen
        $jamTutupAbsen = '15:30:00'; // Jam Tutup absen
        $jamSekarang = date('H:i:s'); // Jam sekarang
        $hari2 = [
            'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'
        ];
        $harisekarang = date('l');

        $absen1 = Absent::where(function ($query) use ($tahun, $bulan, $hari) {
            $query->where('user_id', auth()->user()->id)
                ->whereDate('waktu', '=', "$tahun-$bulan-$hari");
        })->get();
        
        $data = [];
        
        // Cek logika absen
        if ($absen1->isEmpty()) {
            if (in_array($harisekarang, $hari2)) {
                if ($jamSekarang >= $jamBukaAbsen && $jamSekarang <= $jamTutupAbsen) {
                    $data['waktu'] = 'masuk';
                } else {
                    $data['waktu'] = 'tutup';
                }
            } else {
                $data['waktu'] = 'tutup';
            }
        } elseif ($absen1->count() == 1) {
            $data['waktu'] = 'pulang';
        } else {
            $data['waktu'] = 'dilarang';
        }
        
        // Ambil data cuti
        $cuti = Offwork::where(function ($query) use ($bulan, $tahun) {
            $query->where('user_id', auth()->user()->id)
                ->where(function ($query) use ($bulan, $tahun) {
                    $query->whereYear('waktu_pengajuan', '=', "$tahun");
                    $query->whereMonth('waktu_pengajuan', '=', "$bulan");
                });
        })->where('status', '1')->get();
        
        // Cek apakah ada cuti yang berkaitan dengan hari ini
        $cutiSamaHari = $cuti->filter(function ($item) use ($hari) {
            // Ambil tanggal hari ini
            $today = Carbon::today()->format('Y-m-d');
        
            // Ubah tanggal waktu_pengajuan dan waktu_selesai menjadi objek Carbon
            $tanggalPengajuan = Carbon::parse($item->waktu_pengajuan)->format('Y-m-d');
            $tanggalSelesai = Carbon::parse($item->waktu_selesai)->format('Y-m-d');
        
            // Periksa apakah tanggal hari ini berada di antara tanggal pengajuan dan selesai
            return $today >= $tanggalPengajuan && $today <= $tanggalSelesai;
        });
        
        if ($cutiSamaHari->isNotEmpty()) {
            $data['waktu'] = 'cuti';
        }
        
        $countabsen = Absent::where(function ($query) use ($bulan) {
            $query->where('user_id', auth()->user()->id)
                ->where(function ($query) use ($bulan) {
                    $query->whereMonth('waktu', '=', "$bulan");
                });
        })->count();

        $countcuti = Offwork::where(function ($query) use ($bulan) {
            $query->where('user_id', auth()->user()->id)
                ->where(function ($query) use ($bulan) {
                    $query->whereMonth('waktu_pengajuan', '=', "$bulan");
                });
        })->where('status','1')->count();

        return view('karyawan.dashboard', compact('data', 'absen1', 'countabsen', 'countcuti'));
    }

    public function absen(Request $requestuest)
    {
        $absen = new Absent();
        $absen->user_id = auth()->user()->id;
        $absen->keterangan = $requestuest->ket;
        $absen->estimated = $requestuest->by;
        $absen->save();
        return redirect()->back();
    }

    public function daftarabsen()
    {
        $bulan= date('m');
        $absen = Absent::where(function ($query) use ($bulan) {
            $query->where('user_id', auth()->user()->id)
                ->where(function ($query) use ($bulan) {
                    $query->whereMonth('waktu', '=', "$bulan");
                });
        })->get();
        return view('karyawan.daftarabsensi', compact('absen'));
    }

    public function daftarcuti()
    {
        $cuti = Offwork::where('user_id', auth()->user()->id)->paginate();
        return view('karyawan.daftarcutikerja', compact('cuti'));
    }

    public function simpancuti(Request $request)
    {
        $cuti = new Offwork();
        $cuti->user_id = auth()->user()->id;
        $cuti->jenis_cuti = $request->jenis_cuti;
        $cuti->alasan = $request->alasan;
        if ($request->hasFile('foto')) {
            $gambar = $request->file('foto');
            $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('fotocuti'), $namaGambar);
            $cuti->foto = $namaGambar;
        }
        $cuti->status = $request->status;
        $cuti->waktu_pengajuan = $request->waktu_pengajuan;
        $cuti->waktu_selesai = $request->waktu_selesai;
        $cuti->save();
        return redirect()->back();
    }

    public function daftarpayroll()
    {
        $payroll = Payroll::where('id_pegawai', auth()->user()->employee->id)->get();
        return view('karyawan.daftarpayroll',compact('payroll'));
    }
}
