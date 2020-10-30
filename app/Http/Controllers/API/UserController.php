<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index($id=null){
        $user = User::select('id as ID','name as Usuario','email as Correo')->where('id',$id)->get();
        $users = User::select('id as ID','name as Usuario', 'email as Correo')->get();

        if($id)
            return response()->json(["Usuario ".$id => $user],200);
        return response()->json(["USUARIOS:" => $users],200);
    }

    public function create(Request $request){
        // $user = User::insert([
        //     'name' => $request->name,
        //     'email' => $request->email
        // ]);
        //SI FUNCIONA ↑ ↑ ↑ Pero nose como guardarlo en una variable para mostrarlo.

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;

        if($user->insert())
            return response()->json(["Usuario Creado Satisfactoriamente" => $user],201);
        return response()->json(null,400);
    }

    public function update($id ,Request $request){
        // $user = User::where('id',$id)
        //     ->update(['name'=>$request->name, 
        //             'email'=>$request->email]
        // );
        //SI FUNCIONA ↑ ↑ ↑ Pero nose como guardarlo en una variable para mostrarlo.

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');

        if($user->save())
            return response()->json(["Usuario Modificado Satisfactoriamente" => $user],202);
        return response()->json(200,"El usuario no se pudo modificar.");

    }

    public function delete($id){
        $user = User::where('id',$id)->delete();

        return response()->json(["El usuario ".$id." fue eliminado."],200);
    }
}
