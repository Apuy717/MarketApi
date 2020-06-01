<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    protected $table = 'members';
    protected $guarded = [];

    public function payment()
    {
        return $this->hasMany('App\Models\Payment');
    }
}
