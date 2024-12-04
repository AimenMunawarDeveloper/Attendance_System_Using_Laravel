<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:teacher,student'],
        ]);

        $user = User::create([
            'fullname' => $request->fullname,
        'email' => $request->email,
        'password' => bcrypt($request->password),  
        'role' => $request->role, 
        ]);
        $user->password = $request->password;
        $user->email_verified_at = now();
        $user->save();
        event(new Registered($user));

        Auth::login($user);

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
}
