<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class getItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $quantity = 1;
        $total = $this->price_out * $quantity;
        return [
            'barang_code' => $this->code,
            'quantity' => $quantity,
            'sub_total' => $total,
            'name' => $this->name,
            'price' => $this->price_out,
            'unit' => $this->unit->unit
        ];
    }
}
