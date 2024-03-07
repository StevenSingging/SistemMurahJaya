<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;
use App\Models\Employee;
use App\Models\User;
use App\Models\Absent;
use App\Models\Offwork;
use App\Models\Payroll;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{

    public function index()
    {
        return view('admin.dashboard');
    }

    public function pegawai()
    {
        $pegawai = Employee::whereHas('user', function ($query) {
            $query->where('role', 'Pegawai');
        })->paginate();
        return view('admin.pegawai.pegawai', compact('pegawai'));
    }

    public function tambahpegawai()
    {
        $jabatan = Position::all();
        return view('admin.pegawai.tambahpegawai', compact('jabatan'));
    }

    public function detailpegawai($id)
    {
        $peg = Employee::find($id);
        return view('admin.pegawai.detailpegawai', compact('peg'));
    }

    public function simpanpegawai(Request $request)
    {
        $pegawai = new Employee();
        $pegawai->nik = $request->nik;
        $pegawai->nama = $request->nama;
        $pegawai->tempat_lahir = $request->tempat_lahir;
        $pegawai->tgl_lahir = $request->tgl_lahir;
        $pegawai->jenis_kelamin = $request->jenis_kelamin;
        $pegawai->alamat = $request->alamat;
        $pegawai->agama = $request->agama;
        $pegawai->nip = $request->nip;
        if ($request->hasFile('photo')) {
            $gambar = $request->file('photo');
            $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('fotopegawai'), $namaGambar);
            $pegawai->foto = $namaGambar;
        }
        $pegawai->tgl_masuk = $request->tgl_masuk;
        $pegawai->status_pegawai = $request->status_pegawai;
        $pegawai->norek = $request->norek;
        $pegawai->nama_rek = $request->nama_rek;
        $pegawai->no_hp = $request->no_hp;
        $pegawai->id_bagian = $request->id_bagian;
        $pegawai->save();

        $akun = new User();
        $akun->username = $request->username;
        $akun->email = $request->email;
        $akun->employee_id = $pegawai->id;
        $akun->password = bcrypt($request->password);
        $akun->role = 'Pegawai';
        $akun->save();
        return redirect('/pegawai/admin')->with(array(
            'message' => 'Anda berhasil mengupdate kategori',
            'alert-type' => 'success'
        ));
    }

    public function hapuspegawai($id)
    {
        $peg = Employee::find($id);
        $peg->delete();
        return redirect()->back();
    }

    public function jabatan()
    {
        $jbt = Position::paginate();
        return view('admin.jabatan.jabatan', compact('jbt'));
    }

    public function simpanjabatan(Request $request)
    {
        $jabatan = new Position();
        $jabatan->nama_jabatan = $request->nama_jabatan;
        $jabatan->gaji_pokok = $request->gaji_pokok;
        $jabatan->tunjangan = $request->tunjangan;
        $jabatan->save();
        return redirect()->back()->with(array(
            'message' => 'Anda berhasil menambah jabatan',
            'alert-type' => 'success'
        ));
    }

    public function updatejabatan($id, Request $request)
    {
        $jbt = Position::find($id);
        $jbt->nama_jabatan = $request->nama_jabatan;
        $jbt->gaji_pokok = $request->gaji_pokok;
        $jbt->tunjangan = $request->tunjangan;
        $jbt->save();
        return redirect()->back()->with(array(
            'message' => 'Anda berhasil mengupdate jabatan',
            'alert-type' => 'success'
        ));
    }

    public function hapusjabatan($id)
    {
        $jbt = Position::find($id);
        $jbt->delete();
        return redirect()->back()->with(array(
            'message' => 'Anda berhasil menghapus jabatan',
            'alert-type' => 'success'
        ));
    }

   

    public function absensi()
    {
        $absent = Absent::paginate();
        return view('admin.absensi.absensi', compact('absent'));
    }

    public function cuti()
    {
        $cuti = Offwork::paginate();
        return view('admin.cuti.cuti', compact('cuti'));
    }

    public function updatestatuscuti($id, Request $request)
    {
        $cuti = Offwork::find($id);
        $cuti->status = $request->status;
        $cuti->save();

        return redirect()->back()->with(array(
            'message' => 'Anda berhasil update status cuti',
            'alert-type' => 'success'
        ));
    }

    public function payroll()
    {
        $payroll = Payroll::paginate();

        return view('admin.payroll.payroll', compact('payroll'));
    }


    public function tambahpayroll()
    {
        $pegawai = Employee::whereHas('user', function ($query) {
            $query->where('role', 'Pegawai');
        })->paginate();
        return view('admin.payroll.tambahpayroll', compact('pegawai'));
    }

    public function simpanpayroll(Request $request)
    {

        $tahun = date('Y');
        $bulan = date('m');
        $hari = date('d');
        $id_pegawai = $request->input('id_pegawai');
        $employee = Employee::select('*')->where('id',  $id_pegawai)->first();
        $absent = Absent::where(function ($query) use ($bulan, $tahun, $employee) {
            $query->where('user_id', $employee->user->id)
                ->where(function ($query) use ($bulan, $tahun) {
                    $query->whereYear('estimated', '=', "$tahun");
                    $query->whereMonth('estimated', '=', "$bulan");
                });
        })->get();
        $cuti = Offwork::where(function ($query) use ($employee, $tahun) {
            $query->where('user_id', $employee->user->id)
                ->where(function ($query) use ($tahun) {
                    $query->whereYear('waktu_pengajuan', '=', "$tahun");
                });
        })->where('status','1')->count();
        // $groupedCuti = $cuti->mapToGroups(function ($item) {
        //     $startDate = Carbon::parse($item->waktu_pengajuan)->startOfWeek(Carbon::MONDAY);
        //     $endDate = Carbon::parse($item->waktu_selesai);
        
        //     // Jika tanggal selesai melewati akhir minggu, geser tanggal awal ke minggu berikutnya
        //     if ($endDate->greaterThan($startDate->copy()->endOfWeek(Carbon::SUNDAY))) {
        //         $startDate->addWeek();
        //     }
        
        //     return [$startDate->format('Y-m-d') => $item];
        // });

        $groupedAbsent = $absent->groupBy(function ($item) {
            return Carbon::parse($item->estimated)->startOfWeek(Carbon::MONDAY)->format('Y-m-d');
        });

        $count = 0;
        $alpha = 0;

        foreach ($groupedAbsent as $week => $days) {
            // Inisialisasi array untuk menyimpan kehadiran setiap hari dalam minggu
            $dailyAttendance = [];

            foreach ($days as $day) {
                // Ambil tanggal estimasi absensi
                $estimatedDate = $day->estimated;

                // Tambahkan entri kehadiran ke dalam array harian
                if (!isset($dailyAttendance[$estimatedDate])) {
                    $dailyAttendance[$estimatedDate] = [];
                }
                $dailyAttendance[$estimatedDate][] = $day->keterangan;
            }

            // Iterasi setiap hari dalam minggu
            foreach ($dailyAttendance as $day => $attendance) {
                // Ambil tanggal estimasi absensi
                $estimatedDate = $day;

                // Periksa apakah tanggal estimasi berada dalam rentang minggu yang sedang diproses
                if (Carbon::parse($estimatedDate)->weekOfYear == Carbon::now()->weekOfYear) {
                    // Jika ya, periksa kehadiran
                    if (in_array('masuk', $attendance) && in_array('pulang', $attendance)) {
                        $count++; // Jika ada pasangan 'masuk' dan 'pulang', tambahkan ke jumlah absen
                    } else {
                        $alpha++; // Jika tidak ada pasangan 'masuk' dan 'pulang', tambahkan ke jumlah alpha
                    }
                }
            }
        }
        $payroll = new Payroll();
            $payroll->kode_payroll = $request->kode_payroll;
            $payroll->tgl_payroll = $request->tgl_payroll;
            $payroll->waktu_payroll = $request->waktu_payroll;
            $payroll->id_pegawai = $request->id_pegawai;
            $payroll->nama_jabatan = $request->nama_jabatan;
            $payroll->hadir = $count;
            $payroll->alpha = 6-$count;
            $payroll->status = '1';
            if ($request->is_active) {
                
                if($cuti != null){
                    if($cuti > 12){
                        $hitungcuti = ($cuti - 1) % 12 + 1;
                        $payroll->gaji_total = $request->gaji_pokok + $request->tunjangan - ($request->gaji_pokok * $hitungcuti);
                        $payroll->tunjangan = $request->tunjangan;
                    }else{
                        $payroll->gaji_total = $request->gaji_pokok + $request->tunjangan;
                        $payroll->tunjangan = $request->tunjangan;
                    }
                }else{
                    $payroll->gaji_total = $request->gaji_pokok + $request->tunjangan;
                    $payroll->tunjangan = $request->tunjangan;
                }
                
            } else {
                if($cuti != null){
                    if($cuti > 12){
                        $hitungcuti = ($cuti - 1) % 12 + 1;
                        $payroll->gaji_total = $request->gaji_pokok - ($request->gaji_pokok * $hitungcuti);
                    }else{
                        $payroll->gaji_total = $request->gaji_pokok;
                    }

                }else{
                    $payroll->gaji_total = $request->gaji_pokok;
                }
               
            }
            // dd($request->is_active);
            $payroll->save();

            return redirect('payroll/admin')->with(array(
                'message' => 'Anda berhasil membuat payroll',
                'alert-type' => 'success'
            ));
    }

    public function autocomplete(Request $request)
    {
        try {
            $tahun = date('Y');
            $bulan = date('m');
            $id_pegawai = $request->input('id_pegawai');
            $employee = Employee::select('*')->where('id',  $id_pegawai)->first();
            $absent = Absent::where(function ($query) use ($bulan, $tahun, $employee) {
                $query->where('user_id', $employee->user->id)
                    ->where(function ($query) use ($bulan, $tahun) {
                        $query->whereYear('estimated', '=', "$tahun");
                        $query->whereMonth('estimated', '=', "$bulan");
                    });
            })->get();
            $groupedAbsent = $absent->groupBy(function ($item) {
                return Carbon::parse($item->estimated)->startOfWeek(Carbon::MONDAY)->format('Y-m-d');
            });

            $count = 0;
            $alpha = 0;

            foreach ($groupedAbsent as $week => $days) {
                // Inisialisasi array untuk menyimpan kehadiran setiap hari dalam minggu
                $dailyAttendance = [];

                foreach ($days as $day) {
                    // Ambil tanggal estimasi absensi
                    $estimatedDate = $day->estimated;

                    // Tambahkan entri kehadiran ke dalam array harian
                    if (!isset($dailyAttendance[$estimatedDate])) {
                        $dailyAttendance[$estimatedDate] = [];
                    }
                    $dailyAttendance[$estimatedDate][] = $day->keterangan;
                }

                // Iterasi setiap hari dalam minggu
                foreach ($dailyAttendance as $day => $attendance) {
                    // Ambil tanggal estimasi absensi
                    $estimatedDate = $day;

                    // Periksa apakah tanggal estimasi berada dalam rentang minggu yang sedang diproses
                    if (Carbon::parse($estimatedDate)->weekOfYear == Carbon::now()->weekOfYear) {
                        // Jika ya, periksa kehadiran
                        if (in_array('masuk', $attendance) && in_array('pulang', $attendance)) {
                            $count++; // Jika ada pasangan 'masuk' dan 'pulang', tambahkan ke jumlah absen
                        } else {
                            $alpha++; // Jika tidak ada pasangan 'masuk' dan 'pulang', tambahkan ke jumlah alpha
                        }
                    }
                }
            }
            if (!$employee) {
                throw new \Exception('Data not found');
            }
            $id_bagian = $employee->bagian->nama_jabatan;
            $tunjangan = $employee->bagian->tunjangan;
            $gaji_pokok = $employee->bagian->gaji_pokok * $count;

            return response()->json(['id_bagian' => $id_bagian, 'gaji_pokok' => $gaji_pokok, 'tunjangan' => $tunjangan], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function slippayroll($id)
    {
        $payroll = Payroll::find($id);
        return view('admin.payroll.slippayroll', compact('payroll'));
    }

    public function laporanabsen(Request $request)
    {
        $awal = $request->awal;
        $akhir = $request->akhir;

        if(isset($awal, $akhir)){
            $absent = Absent::where(function ($query) use ($awal, $akhir) {
                $query->whereBetween('waktu', [$awal, $akhir]);
            })->get();
        } else {
            $absent = Absent::all();
        }
       
        return view('admin.laporan.laporanabsen',compact('absent'));
    }

    public function laporancuti(Request $request)
    {
        $awal = $request->awal;
        $akhir = $request->akhir;
        
        if(isset($awal, $akhir)){
            $cuti = Offwork::where('waktu_pengajuan', '>=', $awal)
            ->where('waktu_selesai', '<=', $akhir)
            ->get();
        } else {
            $cuti = Offwork::all();
        }
        return view('admin.laporan.laporancuti',compact('cuti'));
    }

    public function laporangaji(Request $request)
    {
        $awal = $request->awal;
        $akhir = $request->akhir;
        
        if(isset($awal, $akhir)){
            $gaji = Payroll::where(function ($query) use ($awal, $akhir) {
                $query->whereBetween('tgl_payroll', [$awal, $akhir]);
            })->get();
        } else {
            $gaji = Payroll::all();
        }
        return view('admin.laporan.laporangaji',compact('gaji'));
    }
}
