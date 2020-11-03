<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

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
        $product = DB::table('products')->select('product','quantity')->where('id',$request->id)->get();
        // dd($product);
        foreach ($product as $key => $value) {
            if($value->quantity > 0){
                return response()->json(["El producto ".$value->product." no se puede eliminar porque aun hay en existencia."],300);
            }
        }

        
        return $next($request);
    }
}
