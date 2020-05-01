<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi_master extends Model
{
    protected $table = 't_master_transaksi';
    protected $guarded = [];

    public function Transaksi()
    {
        return $this->belongsTo('App\Models\Transaksi', 'transaksi_code', 'code_transaksi');
    }
}
