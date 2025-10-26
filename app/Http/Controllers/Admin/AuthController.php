<?php
namespace App\Http\Controllers\Admin;
use Faker\Guesser\Name;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'), $request->remember)) {
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Invalid credentials')->withInput();
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
 