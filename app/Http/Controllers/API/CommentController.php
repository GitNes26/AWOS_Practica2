<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;


class CommentController extends Controller
{
    public function index($id=null){
        
        $comment = Comment::join('users','comments.user_id','users.id')->join('products','comments.product_id','products.id')->select('comments.id as ID','name as Usuario','product as Producto','comment as Comentario')->where('comments.id',$id)->get(); 

        $comments = Comment::join('comments.id as ID','users','comments.user_id','users.id')->join('products','comments.product_id','products.id')->select('name as Usuario','product as Producto','comment as Comentario')->get();

        if($id)
            return response()->json(["Comentario: ".$id => $comment],200);
        return response()->json(["COMENTARIOS:" => $comments],200);
    }

    public function create(Request $request){
        $comment = Comment::insert([
            'comment'=> $request->comment,
            'user' => $request->user,
            'product' => $request->product,
        ]);
        //SI FUNCIONA ↑ ↑ ↑ Pero nose como guardarlo en una variable para mostrarlo.

        $comment = new Comment;
        $comment->comment = $request->comment;
        $comment->user = $request->user;
        $comment->product = $request->product;

        if($comment->save())
            return response()->json(["Usuario Creado Satisfactoriamente"=>$comment],200);
        return response()->json(null,400);
    }

    public function update($id){
        $comment = User::where('id',$id)
            ->update(['comment' => $request->comment,
                      'user' => $request->user,
                      'product' => $request->product]
        );
        //SI FUNCIONA ↑ ↑ ↑ Pero nose como guardarlo en una variable para mostrarlo.

        $comment = Comment::find($id);
        $comment->comment = $request->get('comment');
        $comment->user = $request->get('user');
        $comment->product = $request->get('product');

        if($comment->save())
            return response()->json(["El comentario ".$id." fue modificado."=>$comment],200);
        return response()->json(null,400);
    }

    public function delete($id){
        $comment = Comment::where('id', $id)->delete();

        return response()->json(["El usuario ".$id." fue eliminado."],200);
    }

    public function queryUser($user){
        
        $queryUser = Comment::join('users','comments.user_id','users.id')->join('products','comments.product_id','products.id')->select('comments.id as ID','comment as Comentario','product as Producto')->where('name',$user)->get();
        
        if($user)
            return response()->json(["Comentarios hechos por el usuario ".$user=>$queryUser],200);
    }

    public function queryProduct($product){
        
        $queryProduct = Comment::join('users','comments.user_id','users.id')->join('products','comments.product_id','products.id')->select('comments.id as ID','comment as Comentario','name as Usuario')->where('product',$product)->get();
        
        if($product)
            return response()->json(["Comentarios hecho al producto ".$product=>$queryProduct],200);
    }
}
