<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

         // Get the authenticated user
         $user = Auth::user();

         // Redirect based on the user's role
         if ($user->role === 'teacher') {
             return redirect()->route('dashboard'); // Redirect to teacher dashboard
         } elseif ($user->role === 'student') {
             return redirect()->route('student.dashboard'); // Redirect to student dashboard
         }
 
         // Optionally, you could handle users with other roles or invalid roles
         // For now, we can return a 403 Forbidden or redirect them to a specific page.
         return abort(403, 'Unauthorized');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
