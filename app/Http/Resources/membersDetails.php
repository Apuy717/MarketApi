<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class membersDetails extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $saldoPay = [];
        foreach ($this->payment as $pay) {
            $saldoPay[] = $pay->saldo_pay;
        }
        $payment = array_sum($saldoPay);
        return
            [
                'id' => $this->id,
                'name' => $this->name,
                'no_hp' => $this->no_hp,
                'alamat' => $this->alamat,
                'status' => $this->status,
                'alamat' => $this->alamat,
                'saldo_pay' => $payment,
                'information' => $this->information,
                'created_at' => (string) $this->created_at,
                'updated_at' => (string) $this->updated_at,
            ];
    }
}
