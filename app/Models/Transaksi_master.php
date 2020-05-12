<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi_master extends Model
{
    protected $table = 't_master_transaksi';
    // protected $guarded = [];
    protected $fillable = ['id'];

    public function transaksi()
    {
        return $this->belongsTo('App\Models\Transaksi', 'transaksi_code', 'code_transaksi');
    }

    public function barang()
    {
        return $this->belongsTo('App\Models\Barang', 'barang_code', 'code');
    }
}
