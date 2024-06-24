<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function getUser(Request $request)
    {

        info($request->user());
        return response()->json($request->user());
    }
    // public function getUser(Request $request)
    // {
    //     $user = $request->user();
    //     if (!$user) return response()->json("sem user");
    //     if ($user->is_admin) return response()->json($request->user(), 'User');
    //     else return response()->json($request->user(), 'Admin');
    // }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        //Validar se a criação deu certo
        if ($user)
            return response()->json(['message' => 'Usuário criado com sucesso', 'user' => $user], 201);
        else
            return response()->json(['message' => 'Não foi possível salvar o usuário'], 500);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();
        // Validar se o usuário existe e se as senhas são iguais
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Credenciais inválidas.'
            ], 401);
        }

        //Prepara o token para o retorno
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function logout(Request $request)
    {
        info($request);
        // Verificar se o usuário está autenticado e se há um token atual
        if ($request->user() && $request->user()->currentAccessToken()) {
            // Deletar o token atual
            if ($request->user()->currentAccessToken()->delete()) {
                return response()->json([
                    'success' => true
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'token inválido'
                ], 401);
            }
        } else {
            // Retornar um erro de não autorizado se não houver token presente
            return response()->json([
                'success' => false
            ], 401);
        }
    }

    public function validateUserAdmin(Request $request)
    {
        $user = $request->user();
        info($user);
        if (!$user->is_admin) {
            $errorCode = config('errors.codes.AUTH_UNAUTHORIZED');
            return response([
                'error' => 'AUTH_UNAUTHORIZED',
                'code' => $errorCode,
                'message' => config('errors.messages.' . $errorCode)
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}
