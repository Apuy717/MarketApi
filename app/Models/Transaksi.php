<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    protected $table = 't_transaksi';
    protected $guarded = [];

    public function Transaksi_master()
    {
        return $this->hasMany('App\Models\Transaksi_master', 'transaksi_code', 'code_transaksi');
    }
}
