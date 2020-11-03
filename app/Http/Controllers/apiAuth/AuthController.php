<?php

namespace App\Http\Controllers\apiAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illumainate\Support\MessageBag;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function index(Request $request){
        if($request->user()->tokenCan('user:info') && $request->user()->tokenCan('admin:admin'))
            return response()->json(["'USUARIOS"=>User::all()],200);
        if($request->user()->tokenCan('user:info'))
            return response()->json(["Mi perfil"=> $request->user()],200);
        abort(401, "Scope invalido");
    }

    public function grantPermissions(Request $request){
        $rolUser = DB::table('roles_users')->join('users','roles_users.user_id','users.id')->join('roles','roles_users.role_id','roles.id')->select('users.name','roles.role')->where('users.name',$request->user)->first();
        foreach ($variable as $user) {
            if($user->role == 4)
                return 

        }
    }

    public function registry(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|size:6'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if($user->save())
            return response()->json($user,201);
        return abort(422,"Error al crear usuario.");
    }

    public function logIn(Request $request){
        $request->validate([
            'name'=>'required',
            'password'=>'required'
        ]);

        $user = User::where('name',$request->name)->first();
        
        if(!$user || !Hash::check($request->password, $user->password)){
            throw ValidationException::withMessages([
                'name|password' => ['Usuario o Contraseña incorrecta']
            ]);
        }

        $token = $user->createToken($request->name, ['user:info', 'admin:admin'])->plainTextToken;
            return response()->json(['token' => $token],201);
    }

    public function logOut(Request $request){
        return response()->json(["Tokens eliminados" => $request->user()->tokens()->delete()],200);
    }

    
}
