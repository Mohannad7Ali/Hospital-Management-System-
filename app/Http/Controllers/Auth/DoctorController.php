<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\DoctorLoginRequest;

class DoctorController extends Controller
{

    public function store(DoctorLoginRequest $request)
    {

        if ($request->authenticate()) {
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::DOCTOR);
        }

        return redirect()->back()->withErrors(['name' => (trans('dashboard/auth.failed'))]);
    }




    public function destroy(Request $request)
    {

        Auth::guard('doctor')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
