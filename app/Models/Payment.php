<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';
    protected $guarded = [];

    public function members()
    {
        return $this->belongsTo('App\Models\Payment');
    }
}
