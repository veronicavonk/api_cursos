<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Hash;

class AuthController extends Controller
{


	/**
     * API Register
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

     public function registro(Request $request)
     {
        $name = $request->nombre;
        $email = $request->email;
        $password = $request->password;
        $pais = $request->pais;
        $genero = $request->genero;
        $fecha_nacimiento = $request->fecha_nacimiento;
        $usuario = $request->usuario;
        $telefono = $request->telefono;

        $user = Usuario::create([
        	'usu_nombre' => $name,
        	'usu_email' => $email,
        	'usu_password' => Hash::make($password),
        	'usu_telefono'=>$telefono,
        	'usu_nick'=>$usuario,
        	'usu_pais'=>$pais,
        	'usu_genero'=>$genero,
        	'usu_fecha_nacimiento'=>$fecha_nacimiento]);

        return response()->json(['finalizado'=> true, 'message'=> 'Cuenta creada correctamente'],200);
    }
   
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login']]);
    // }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {	
    	$email=$request->email;
    	$password=$request->password;
        $credentials = ['usu_email'=>$email, 'password'=>$password];
        // return response()->json(["rew"=>$request->all(),"rew2"=>$credentials]);
        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['finalizado'=>false,'mensaje' => 'Usuario o contraseña incorrecto, Intente nuevamente.'], 401);
        }
        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}






