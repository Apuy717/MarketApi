<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 't_barang';
    protected $guarded = [];

    public function unit()
    {
        return $this->belongsTo('App\Models\Unit');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function Transaksi_master()
    {
        return $this->hasMany('App\Models\Transaksi_master', 'barang_code', 'code');
    }
}
