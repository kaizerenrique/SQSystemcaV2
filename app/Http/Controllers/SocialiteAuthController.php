<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialiteAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {
        $providerUser = Socialite::driver('facebook')->user();
        $user = User::where('email', $providerUser->getEmail())->first();
        
        //comprobar si el usuario está registrado
        if (!$user) {
            // Generar contraseña aleatoria
            $plainPassword = Str::password(12); // 12 caracteres con combinación de letras, números y símbolos
            
            // Enviar correo con la contraseña en texto plano
            //Mail::to($providerUser->getEmail())->send(new PasswordGeneratedMail($plainPassword));

            $user = User::create([
                'email' => $providerUser->getEmail(),
                'name' => $providerUser->getName(),
                'password' => Hash::make('123456789'),
            ])->assignRole('Usuario');
        }

        $user->authProviders()->updateOrCreate([
            'provider' => 'facebook',
        ], [
            'provider_id' => $providerUser->getId(),
            'avatar' => $providerUser->getAvatar(),
            'token' => $providerUser->token,
            'nickname' => $providerUser->getNickname(),
            'login_at' => Carbon::now(),
        ]);

        Auth::login($user);

        return redirect('/dashboard');
        
    }
}
