<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 't_category';
    protected $guarded = [];

    public function barang()
    {
        return $this->hasMany('App\Models\Category');
    }
}
