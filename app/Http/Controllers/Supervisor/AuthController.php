<?php

namespace App\Http\Controllers\Supervisor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login_view()
    {
        if (Auth::guard('supervisor')->user()) {
            return redirect(route('supervisor.home'));
        }
        return view('supervisor.auth.login');
    }

    public function login(Request $request)
    {
        if (Auth::guard('supervisor')->attempt([
            'email' => $request->email,
            'password' => $request->password,
            'active' => 1,
        ])) {
            return redirect(route('supervisor.home'));
        } else {
            session()->flash('error', 'البريد الإلكتروني او كلمة المرور خطأ , يرجى المحاوله مره اخرى !');
            return back();
        }
    }

    public function logout()
    {
        Auth::guard('supervisor')->logout();
        return redirect('supervisor/login');
    }
}
