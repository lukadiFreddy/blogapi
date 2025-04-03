<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Il permet de s'inscrire
     */
    public function inscription(Request $req)
    {
        try {
            $req->validate([
                'nom' => 'required|string',
                'postnom' => 'required|string',
                'prenom' => 'required|string',
                'photo' => 'sometimes|image|max:5120',
                'email' => 'required|string',
                'password' => 'required|string|min:6'
            ]);

            if (User::where('email', $req->email)->exists()){
                return response()->json([
                    'message' => "Cette adresse email est déjà utilisé par un autre compte !"
                ], Response::HTTP_NOT_ACCEPTABLE);
            }

            $user = User::create([
                'nom' => $req->nom,
                'postnom' => $req->postnom,
                'prenom' => $req->prenom,
                'email' => $req->email,
                'password' => Hash::make($req->password),
            ]);



            if ($req->hasFile('photo')) {
                $path = $req->file('photo')->store('photos', 'public');
                $user->update(['photo' => $path]);
            }

            return response()->json([
                'message' => "L'inscription a reussie",
            ], Response::HTTP_OK);

        } catch (\Exception $e) {

            return response()->json([
                'message' => "L'inscription a échouée : " . $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
