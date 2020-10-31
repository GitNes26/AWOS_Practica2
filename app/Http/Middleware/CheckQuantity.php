<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class CheckQuantity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $product = Product::select('product','quantity')->where('id',$request->id)->get();
        // dd($product);
        if($product->quantity > 0){
            return response()->json(["El producto ".$Product->product." no se puede eliminar porque aun hay en existencia."],300);
        }
        return $next($request);
    }
}
