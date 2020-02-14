<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Billetera extends Model
{
    //
    protected $table = 'billetera';

    public function user()
    {
        return $this->hasOne('App\User');
    }
}
