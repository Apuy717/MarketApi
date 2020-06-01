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
        if ($this->stock > 0) {
            return [
                'barang_code' => $this->code,
                'quantity' => $quantity,
                'stock' => $this->stock,
                'sub_total' => $total,
                'name' => $this->name,
                'price_seller' => $this->price_seller,
                'price_members' => $this->price_members,
                'price' => $this->price_out,
                'unit' => $this->unit->unit
            ];
        } else {
            return [
                'error' => $this->name . ' ' . 'barang kosong',

            ];
        }
    }
}
