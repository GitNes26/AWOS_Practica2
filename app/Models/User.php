<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users'; //confirmar que este modelo pertenece a tal tabla

    public function comments(){
        return $this->hasMany('App\Models\Comment');
        // Esta tabla 'users(User)' TIENE UNA RELACION con la tabla 'comments(Comment)
    }
}
