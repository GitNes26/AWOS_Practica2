<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CommentController extends Controller
{
    public function index($id=null){
        
        $comment = DB::table('comments')->join('users','comments.user_id','users.id')->join('products','comments.product_id','products.id')->select('name as Usuario','product as Producto','comment as Comentario')->where('comments.id',$id)->get(); 

        $comments = DB::table('comments')->join('users','comments.user_id','users.id')->join('products','comments.product_id','products.id')->select('name as Usuario','product as Producto','comment as Comentario')->get();

        if($id)
            return response()->json(["Comentario: ".$id =>$comment],200);
        return response()->json(["COMENTARIOS:"=>$comments],200);
    }
}
