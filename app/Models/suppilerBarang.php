<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class suppilerBarang extends Model
{
    protected $table = 'suppilerBarang';
    protected $guarded = [];

    public function suppiler()
    {
        return $this->belongsTo('App\Models\Suppiler');
    }

    public function barang()
    {
        return $this->belongsTo('App\Models\Barang');
    }
}
