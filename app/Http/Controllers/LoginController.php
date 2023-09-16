<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\HelloMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Mail\VerificationEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\Mail\VerificationEmailAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginproses(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/');
        }
        return redirect('login');
    }

    public function register()
    {
        return view('register');
    }

    public function registeruser(Request $request)
    {
        $data = $request->validate([
            'nip' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Buat token verifikasi acak
        $verificationToken = Str::random(60);

        $user = new User;
        $user->nip = $data['nip'];
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->role = 'Umum'; // Set peran sebagai 'Umum'
        $user->verification_token = $verificationToken;
        $user->remember_token = Str::random(60); // Isi remember_token dengan nilai acak

        $user->save();

        // Generate verification URL
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'user' => $user->id,
                'hash' => $user->verification_token
            ]
        );

        // Kirim email verifikasi
        Mail::to($user->email)->send(new VerificationEmail($user, $verificationUrl));

        // var_dump($data);
        return redirect()->route('verification.notice.first');
    }

    public function registeradmin(Request $request)
    {
        $data = $request->validate([
            'nip' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        // Buat token verifikasi acak
        $verificationToken = Str::random(60);

        $user = new User;
        $user->nip = $data['nip'];
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->role = $data['role'];
        $user->latitude = $data['latitude'];
        $user->longitude = $data['longitude'];
        $user->verification_token = $verificationToken;
        $user->remember_token = Str::random(60);

        $user->save();

        // Kirim email verifikasi
        // Mail::to($user->email)->send(new VerificationEmailAdmin($user, $verificationToken));

        // Redirect ke halaman verification-notice untuk admin
        return redirect()->route('verification.notice');
    }


    public function verificationNotice()
    {
        return view('verification-notice');
    }
    public function verificationNoticee()
    {
        return view('verification-noticee');
    }
    public function verificationNoticeFirst()
    {
        return view('verification-notice-first');
    }

    public function verificationNoticeSecond()
    {
        return view('verification-notice-second');
    }
    public function verificationNoticeSecondd()
    {
        return view('verification-notice-secondd');
    }

    public function verificationNoticeThird()
    {
        return view('verification-notice-third');
    }

    public function verifyEmail(Request $request, $user, $hash)
    {
        $user = User::where('id', $user)->where('verification_token', $hash)->first();

        if ($user) {
            // Token cocok, tandai email_verified_at dengan waktu saat ini
            $user->email_verified_at = Carbon::now();
            $user->save();

            return redirect()->route('verification.notice.third')
                ->with('success', 'Email berhasil diverifikasi. Silakan masuk.');
        } else {
            return redirect('/verification-error')->with('error', 'Token verifikasi tidak valid.');
        }
    }
    public function logout()
    {
        Auth::logout();
        return view('login');
    }
}
