<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index($id=null){
        $product = Product::select('id as ID','product as Producto','quantity as En existencia')->where('id',$id)->get();
        $products = Product::select('id as ID','product as Producto', 'quantity as En existencia')->get();

        if($id)
            return response()->json(["Producto ".$id => $product],200);
        return response()->json(["PRODUCTOS:" => $products],200);
    }

    public function create(Request $request){
        // $product = Product::insert([
        //     'product' => $request->product,
        //     'quantity' => $request->quantity
        // ]);
        //SI FUNCIONA ↑ ↑ ↑ Pero nose como guardarlo en una variable para mostrarlo.

        $product = new Product;
        $product->product = $request->product;
        $product->quantity = $request->quantity;

        if($product->insert())
            return response()->json(["Producto Creado Satisfactoriamente" => $product],201);
        return response()->json(null,400);
    }

    public function update($id ,Request $request){
        // $product = Product::where('id',$id)
        //     ->update(['product'=>$request->product, 
        //             'quantity'=>$request->quantity]
        // );
        //SI FUNCIONA ↑ ↑ ↑ Pero nose como guardarlo en una variable para mostrarlo.

        $product = Product::find($id);
        $product->product = $request->get('product');
        $product->quantity = $request->get('quantity');

        if($product->save())
            return response()->json(["Producto Modificado Satisfactoriamente" => $product],202);
        return response()->json(200,"El producto no se pudo modificar.");

    }

    public function delete($id){
        $product = Product::where('id',$id)->delete();

        return response()->json(["El producto ".$id." fue eliminado."],200);
    }
}
