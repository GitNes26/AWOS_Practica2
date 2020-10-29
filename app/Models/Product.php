<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products'; //confirmar que este modelo pertenece a tal tabla

    public function comments(){
        return $this->hasMany('App\Models\Comment');
        // Esta tabla 'products(Product)' TIENE UNA RELACION con la tabla 'comments(Coment)'
    }
}
