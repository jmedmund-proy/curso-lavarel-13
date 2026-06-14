<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Muestra el formulario de edición de perfil.
     */
    public function edit()
    {
        // Obtenemos el perfil o lo creamos si el usuario no tiene uno
        $profile = Auth::user()->profile()->firstOrCreate([
            'user_id' => Auth::id()
        ]);

        return view('auth.profile', compact('profile'));
    }

    /**
     * Actualiza el perfil en la base de datos.
     */
    public function update(Request $request)
    {
        $request->validate([
            'address' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
        ]);

        $user = Auth::user();
    
        // Traemos el perfil actual (puede ser null si es nuevo)
        $profile = $user->profile; 
        $data = $request->only('address');

        if ($request->hasFile('avatar')) {
            // Opcional: Eliminar avatar anterior si existe
            if ($profile && $profile->avatar) {
                Storage::disk('public')->delete($profile->avatar);
            }

            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id], // Condición para buscar
            $data                     // Datos para insertar o actualizar
        );

        return back()->with('status', 'Perfil actualizado correctamente');
    }
}