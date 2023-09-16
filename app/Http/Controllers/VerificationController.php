<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Verified;

class VerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Hanya user yang telah login yang dapat mengakses
        $this->middleware('signed')->only('verify'); // Hanya tanda tangan yang valid yang dapat mengakses verifikasi
        $this->middleware('throttle:6,1')->only('verify', 'resend'); // Batasi frekuensi permintaan verifikasi
    }

    public function verify(EmailVerificationRequest $request)
    {
        if ($request->route('id') == $request->user()->getKey() &&
            hash_equals((string) $request->route('hash'), sha1($request->user()->getEmailForVerification()))) {

            if ($request->user()->hasVerifiedEmail()) {
                return redirect()->route('verification.notice.third');
            }

            if ($request->user()->markEmailAsVerified()) {
                event(new Verified($request->user()));
            }

            return redirect()->route('verification.notice.third')->with('success', 'Email berhasil diverifikasi.');
        }

        return redirect('/verification-error')->with('error', 'Token verifikasi tidak valid.');
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('verification.notice.third')->with('info', 'Email sudah terverifikasi.');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('success', 'Email verifikasi telah dikirim ulang.');
    }
}
