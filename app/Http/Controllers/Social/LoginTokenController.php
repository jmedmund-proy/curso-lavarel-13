<?php

namespace App\Http\Controllers\Social;

use App\Http\Controllers\Controller;
use App\Mail\LoginTokenMail;
use App\Models\LoginToken;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class LoginTokenController extends Controller
{
    public function showEmailForm(): View {
        return view('auth.login-token-email');
    }

    public function sendToken(Request $request): RedirectResponse {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        $user = User::where('email', $request->email)->first();

        $loginToken = LoginToken::generateForUser($user);

        session(['login_token_id' => $loginToken->id]);

        //Enviar correo
        Mail::to($user)->send(new LoginTokenMail($user, $loginToken->token));      

        return redirect()->route('login.token.code');
    }

    public function resendToken(): RedirectResponse
    {
        $tokenID = session('login_token_id');

        if (! $tokenID) {
            return redirect()->route('auth.login-token-email')
                ->withErrors(['email' => 'La sesión expiró. Ingresa tu correo nuevamente.']);
        }

        $oldToken = LoginToken::find($tokenID);

        if (! $oldToken) {
            return redirect()->route('auth.login-token-email');
        }

        // Generamos un nuevo token para el mismo usuario
        $newToken = LoginToken::generateForUser($oldToken->user);

        // Actualizamos el ID en la sesión
        session(['login_token_id' => $newToken->id]);

        // Enviamos el correo
        Mail::to($oldToken->user)->send(new LoginTokenMail($oldToken->user, $newToken->token));

        return redirect()->back()
            ->with('status', 'Te hemos reenviado un nuevo código a tu correo.');
    }

    public function showCodeForm(): View|RedirectResponse {
        if(! session('login_token_id')) {
            return redirect()->route('auth.login-token-email');
        }

        return view('auth.login-token-code');
    }

    public function verifyToken(Request $request): RedirectResponse {
        $request->validate([
            'token' => ['required', 'string', 'size:6'],
        ]);

        $tokenID = session('login_token_id');

        if (! $tokenID) {
            return redirect()->route('auth.login-token-email')
                ->withErrors(['email' => 'La sesión ha expirado. Solicita un nuevo codigo.']);
        }

        $loginToken = LoginToken::find($tokenID);

        if (! $loginToken || ! $loginToken->isValid()) {
            // session()->forget('login_token_id'); No hace falta quitar la sesion aqui
            // Que solo regrese y no vaya a correo
            // return redirect()->route('auth.login-token-email')
            return redirect()->back()
                ->withErrors(['email' => 'El código ha expirado. Solicita uno nuevo.']);
        
        }

        if ($loginToken->token !== $request->token) {
            return redirect()->back()
                ->withErrors(['token' => 'El código ingresado no es correcto.']);
        }

        $user = $loginToken->user;

        Auth::login($user);
        $loginToken->delete();
        session()->forget('login_token_id');
        session()->regenerate();

        return redirect()->intended('/dashboard/post');
    }
}
