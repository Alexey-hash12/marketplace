<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function index()
    {
        if (Auth::user()->role == User::ROLE_ADMIN) {
            return redirect()->route('admin.index');
        } else if (Auth::user()->role == User::ROLE_LOGIST) {
            return redirect()->route('admin.logist');
        } else if (Auth::user()->role == User::ROLE_STORE_KEEPER) {
            return redirect()->route('admin.store_keeper');
        } else if (Auth::user()->role == User::ROLE_PACKER) {
            return redirect()->route('admin.packer');
        }

        abort(404);
    }
}
