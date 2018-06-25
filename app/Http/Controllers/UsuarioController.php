<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    //
      public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);
        if(!$usuario){
            return response()->json(['finalizado'=>false,"mensaje" => 'No existe el usuario.'], 404);  
        }
        $usuario->usu_nombre=$request->nombre;
        $usuario->usu_nick=$request->usuario;
        $usuario->usu_pais=$request->pais;
        $usuario->usu_telefono=$request->telefono;
        $usuario->usu_genero=$request->genero;
        $usuario->usu_fecha_nacimiento=$request->fecha_nacimiento;

        if($request->hasFile('foto'))
        { 
            $validator = Validator::make($request->all(), [
                        'foto' => 'required|image64:image/jpeg,image/png'
            ]);

            if ($validator->fails()) 
            {
                 return response()->json(["msg" => "exito", "usuario" => 'Formato de imagen inválido.'], 200);  
            }

            $user->foto = $request->file('foto')->store('public');
            $usuario->save();
        }
        $usuario->save(); 
           
        return response()->json(["finalizado"=>true,"message"=>"Datos actualizados.", "user"=>$usuario, "reques"=>$request->all()]);
    }
}
