<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    protected $table = 't_transaksi';
    protected $guarded = [];

    public function master()
    {
        return $this->hasMany('App\Models\Transaksi_master', 'transaksi_code', 'code_transaksi');
    }

    public function admin()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
