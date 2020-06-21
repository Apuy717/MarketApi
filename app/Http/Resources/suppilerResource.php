<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class suppilerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function toArray($request)
    {
        if (count($this->supilerBarang) > 0) {
            foreach ($this->supilerBarang as $brg) {
                $data[] = [
                    "id" => $brg->barang->id,
                    "code" => $brg->barang->code,
                    "name" => $brg->barang->name,
                    "price_in" => $brg->barang->price_in,
                    "price_seller" => $brg->barang->price_seller,
                    "price_members" => $brg->barang->price_members,
                    "price_out" => $brg->barang->price_out,
                    "expired" => $brg->barang->expired,
                    "stock" => $brg->barang->stock,
                    "unit" => $brg->barang->unit->unit,
                    "category" => $brg->barang->category->category,
                    "status" => $brg->barang->status,
                    "information" => $brg->barang->information,
                    "created_at" => (string) $brg->barang->created_at,
                    "updated_at" => (string) $brg->barang->updated_at,
                ];
            }
        } else {
            $data[] = ['status' => 'empty'];
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'company' => $this->company,
            'contact' => $this->contact,
            'region' => $this->region,
            'status' => $this->status,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'itemSum' => count($data),
            'item' => $data

        ];
    }
}
