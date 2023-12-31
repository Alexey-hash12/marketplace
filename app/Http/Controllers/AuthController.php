<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return back()->withErrors(['error' => 'Неверный пароль или почта']);
        }


        if (Auth::user()->role == User::ROLE_ADMIN) {
            return redirect()->route('admin.index');
        } else if (Auth::user()->role == User::ROLE_LOGIST) {
            return redirect()->route('admin.logist');
        } else if (Auth::user()->role == User::ROLE_STORE_KEEPER) {
            return redirect()->route('admin.store_keeper');
        } else if (Auth::user()->role == User::ROLE_PACKER) {
            return redirect()->route('admin.packer');
        }
        return redirect()->route('index');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
