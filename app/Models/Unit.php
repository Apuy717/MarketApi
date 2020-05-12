<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 't_unit';
    protected $guarded = [];

    public function barang()
    {
        return $this->hasMany('App\Models\Barang');
    }
}
