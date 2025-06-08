<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pelamar;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    /**
     * Menampilkan halaman profil pelamar
     */
    public function index()
    {
        $pelamar = Pelamar::where('user_id', Auth::id())->first();
        return view('profil-pelamar', compact('pelamar'));
    }

    /**
     * Update alamat pelamar
     */
    public function updateAlamat(Request $request)
    {
        $request->validate([
            'alamat' => 'nullable|string',
        ]);

        $pelamar = Pelamar::where('user_id', Auth::id())->first();
        $pelamar->alamat = $request->alamat;
        $pelamar->save();

        return response()->json(['success' => true]);
    }

    /**
     * Update skill pelamar
     */
    public function updateSkill(Request $request)
    {
        $request->validate([
            'skill' => 'nullable|string',
        ]);

        $pelamar = Pelamar::where('user_id', Auth::id())->first();
        $pelamar->skill = $request->skill;
        $pelamar->save();

        return response()->json(['success' => true]);
    }

    /**
     * Update pengalaman kerja pelamar
     */
    public function updatePengalaman(Request $request)
    {
        $request->validate([
            'pengalaman_kerja' => 'nullable|string',
        ]);

        $pelamar = Pelamar::where('user_id', Auth::id())->first();
        $pelamar->pengalaman_kerja = $request->pengalaman_kerja;
        $pelamar->save();

        return response()->json(['success' => true]);
    }

    /**
     * Update pendidikan pelamar
     */
    public function updatePendidikan(Request $request)
    {
        $request->validate([
            'pendidikan_terakhir' => 'nullable|string|max:255',
            'jurusan' => 'nullable|string|max:255',
            'universitas' => 'nullable|string|max:255',
            'tahun_lulus' => 'nullable|integer|min:1900|max:' . (date('Y') + 5),
        ]);

        $pelamar = Pelamar::where('user_id', Auth::id())->first();
        $pelamar->pendidikan_terakhir = $request->pendidikan_terakhir;
        $pelamar->jurusan = $request->jurusan;
        $pelamar->universitas = $request->universitas;
        $pelamar->tahun_lulus = $request->tahun_lulus ?: 0;
        $pelamar->save();

        return response()->json(['success' => true]);
    }

    /**
     * Upload CV pelamar
     */
    public function uploadCV(Request $request)
    {
        $request->validate([
            'cv_file' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $pelamar = Pelamar::where('user_id', Auth::id())->first();
        
        // Hapus file lama jika ada
        if ($pelamar->cv_path && Storage::exists('public/' . $pelamar->cv_path)) {
            Storage::delete('public/' . $pelamar->cv_path);
        }
        
        // Upload file baru
        $path = $request->file('cv_file')->store('cv', 'public');
        $pelamar->cv_path = $path;
        $pelamar->save();

        return response()->json([
            'success' => true,
            'file_url' => asset('storage/' . $path)
        ]);
    }

    /**
     * Hapus CV pelamar
     */
    public function deleteCV()
    {
        $pelamar = Pelamar::where('user_id', Auth::id())->first();
        
        // Hapus file jika ada
        if ($pelamar->cv_path && Storage::exists('public/' . $pelamar->cv_path)) {
            Storage::delete('public/' . $pelamar->cv_path);
        }
        
        // Kosongkan field cv_path dengan string kosong (bukan null)
        $pelamar->cv_path = '';
        $pelamar->save();

        return response()->json([
            'success' => true,
            'message' => 'Dokumen berhasil dihapus'
        ]);
    }
} 