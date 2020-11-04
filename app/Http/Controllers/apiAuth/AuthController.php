<?php

namespace App\Http\Controllers\apiAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illumainate\Support\MessageBag;
use Illuminate\Support\Facades\DB;
use App\Models\PersonalAccessToken;

class AuthController extends Controller
{
    public function index(Request $request){
        if($request->user()->tokenCan('admin:admin'))
            // return response()->json(["'USUARIOS"=>DB::table('users')->join('roles_users','users.id','roles_users.user_id')->join('roles','roles_users.role_id','roles.id')->select('users.id','users.name','users.email','roles.role as Permisos')->get()],200);
            return response()->json(["'USUARIOS"=>User::all()],200);
        if($request->user()->tokenCan('user:info'))
            return response()->json(["Mi perfil"=> $request->user()],200);
        abort(401, "Scope invalido");
    }

    public function showPermissions(Request $request){
        if($request->user()->tokenCan('admin:admin'))
            return response()->json([PersonalAccessToken::all()]);
    }
    public function grantPermissions(Request $request, $id){
        // $rolUser = DB::table('roles_users')->join('users','roles_users.user_id','users.id')->join('roles','roles_users.role_id','roles.id')->select('users.name','roles.role as Permisos')->where('users.name',$request->user)->first();

        // foreach ($variable as $user) {
        //     if($user->role == 4){
        //         // return redirect('addPermissions');
        //     }
        if($request->user()->tokenCan('admin:admin')){

            $change = PersonalAccessToken::find($id);
            $change->abilities = $request->ability;
            $change->save();

            if($change->save())
                return response()->json([$change],200);    

            abort(401, "Scope invalido");
            
        }
    }
    public function deleteUser(Request $request, $id){
        if($request->user()->tokenCan('admin:admin')){
            $delete = User::where('id',$id)->delete();
            return response()->json(["El usuario ".$id." fue eliminado."],200);
        }
            
            
        abort(401, "Scope invalido");
        
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

        if($user->id == 1 || $user->id == 2){
            $token = $user->createToken($request->name, ['admin:admin'])->plainTextToken;
            return response()->json(['token de admin' => $token],200);
        }
        if($user->id > 2){
            $token = $user->createToken($request->name, ['user:lector'])->plainTextToken;
            return response()->json(['token de lector' => $token],200);
        }
    }

    public function logOut(Request $request){
        return response()->json(["Tokens eliminados" => $request->user()->tokens()->delete()],200);
    }
    
}
