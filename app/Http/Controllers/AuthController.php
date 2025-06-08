<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Pelamar;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('password'));
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Role-based redirection
            if (Auth::user()->role === 'hrd') {
                return redirect()->route('hrd.dashboard');
            } else {
                return redirect()->route('dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->except('password'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    
    public function showRegistrationForm()
    {
        return view('signup');
    }
    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'terms' => 'required',
        ], [
            'terms.required' => 'Anda harus menyetujui syarat dan ketentuan.',
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except(['password', 'password_confirmation']));
        }

        DB::beginTransaction();
        
        try {
            // Create new user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'pelamar', // Default role for new signups
            ]);
            
            // Create initial pelamar profile with basic info
            Pelamar::create([
                'user_id' => $user->id,
                'nama_lengkap' => $request->name,
                'email' => $request->email,
                'telepon' => $request->phone,
                'alamat' => '',
                'pendidikan_terakhir' => '',
                'jurusan' => '',
                'universitas' => '',
                'tahun_lulus' => 0,
                'cv_path' => '',
                'pengalaman_kerja' => null,
                'skill' => null,
            ]);
            
            DB::commit();
            
            // Log the user in
            Auth::login($user);
            
            // Redirect to dashboard
            return redirect()->route('dashboard');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors(['error' => 'Registration failed. Please try again. ' . $e->getMessage()])
                ->withInput($request->except(['password', 'password_confirmation']));
        }
    }
} 