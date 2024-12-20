<?php

namespace App\Http\Controllers;
use App\Models\Bagian_akademik;
use Illuminate\Support\Facades\Auth;  // Pastikan ini ada
use App\Models\Mahasiswa;
use App\Models\histori_irs;
use App\Models\Dekan;
use App\Models\Dosen;
use App\Models\User;
use App\Models\KetuaProdi;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function dashboardMahasiswa()
{
    // Ambil user yang sedang login
    $user = Auth::user();

    // Ambil data mahasiswa yang terhubung dengan user yang sedang login
    $mahasiswas = Mahasiswa::where('email', $user->email)->get();
    $mahasiswa = Mahasiswa::where('email', $user->email)->first();

    // Hitung total SKS berdasarkan NIM mahasiswa
    $currentSKS = histori_irs::where('nim', $mahasiswa->nim)
    ->join('jadwal_mata_kuliah', 'histori_irs.jadwalid', '=', 'jadwal_mata_kuliah.jadwalid')
    ->join('matakuliah', 'jadwal_mata_kuliah.kodemk', '=', 'matakuliah.kode')
    ->sum('matakuliah.sks')?? 0;

    // Kirim data ke view
    return view('mahasiswa.dashboard_mhs', compact('user', 'mahasiswas', 'currentSKS'));
}

    
    public function dashboardDosen()
    {
        $user = Auth::user();

        // Ambil data mahasiswa yang terhubung dengan user yang sedang login
        //$dosens = Dosen::where('email', $user->email)->get(); // Pastikan ada kolom 'user_id' di tabel mahasiswa
        $users = User::all();


        // Ambil data program studi yang terkait dengan dosen
        $dosens = Dosen::join('programstudi', 'dosen.kodeprodi', '=', 'programstudi.kodeprodi')
        ->where('dosen.email', $user->email) // Pastikan hanya dosen yang sedang login
        ->select('dosen.*', 'programstudi.namaprodi as nama_prodi') // Ambil nama prodi
        ->get();

        // notifikasi pengajuan perubahan irs
        $useremail = Auth::user()->email;
        $dosenwali = Dosen::where('email', $useremail)->first();
        $mahasiswaWithChanges = Mahasiswa::join('irs', 'mahasiswa.nim', '=', 'irs.nim')
            ->where('irs.status_verifikasi', 'mengajukan perubahan')  // Filter status verifikasi
            ->where('mahasiswa.dosenwali', $dosenwali->nip)  // Filter berdasarkan dosen wali
            ->select('mahasiswa.nim', 'mahasiswa.nama', 'irs.status_verifikasi') // Pilih data yang diperlukan
            ->distinct('mahasiswa.nim')
            ->get();
            return view('dosen.dashboard', compact('users','dosens', 'mahasiswaWithChanges')); // Kirim data ke view
    }

    public function dashboardAkademik()
    {
        $user = Auth::user();

    // Ambil data mahasiswa yang terhubung dengan user yang sedang login
        $akademiks = Bagian_akademik::where('email', $user->email)->get(); // Pastikan ada kolom 'user_id' di tabel mahasiswa
        $users = User::all();
            return view('akademik.dashboard', compact('users','akademiks')); // Kirim data ke view
    }

    public function dashboardDekan()
    {
        $user = Auth::user();

    // Ambil data Dekan berdasarkan email user
    $dekans = Dekan::whereHas('dosen', function ($query) use ($user) {
        // Cari dosen yang punya email yang sama dengan user yang login
        $query->where('email', $user->email);
    })->get();

    // Ambil data Dosen yang terkait
    $dosens = Dosen::with('dekan')->get();

    // Kirimkan data ke view
    return view('dekan.dashboard_dekan', compact('dekans', 'dosens'));
    }

    public function dashboardKaprodi()
    {
        $user = Auth::user();

    // Ambil data Dekan berdasarkan email user
    $kaprodis = KetuaProdi::whereHas('dosen', function ($query) use ($user) {
        // Cari dosen yang punya email yang sama dengan user yang login
        $query->where('email', $user->email);
    })->get();

    // Ambil data Dosen yang terkait
    $dosens = Dosen::with('kaprodi')->get();

    // Kirimkan data ke view
    return view('kaprodi.dashboard_kp', compact('kaprodis', 'dosens'));
    }

    public function user1()
    {
        return view('user1');
    }

    public function user2()
    {
        return view('user2');
    }
    
}
