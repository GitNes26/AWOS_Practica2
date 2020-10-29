<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments'; //confirmar que este modelo pertenece a tal tabla

    public function users(){
        return $this->belognsTo('App\Models\User');
        // Esta tabla 'comments(Comment)' PERTENSE A la tabla 'users(User) 
    }

    public function products(){
        return $this->belongsTo('App\Models\Product');
        // Esta tabla 'comments(Coment)' PERTENSE A la tabla 'products(Product)'
    }
}
