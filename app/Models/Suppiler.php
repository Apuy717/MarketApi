<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suppiler extends Model
{
    protected $table = 'suppiler';
    protected $guarded = [];

    public function supilerBarang()
    {
        return $this->hasMany('App\Models\suppilerBarang');
    }
}
