<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransaksiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $datame = [];
        foreach ($this->master as $ms) {
            $datame[] = [
                'id' => $ms->id,
                'barang' => [
                    "id" => $ms->barang->id,
                    "code" => $ms->barang->code,
                    "name" => $ms->barang->name,
                    "price_out" => $ms->barang->price_out,
                    "category" => $ms->barang->category->category,
                    "unit" => $ms->barang->unit->unit,
                    "expired" => $ms->barang->expired,
                    "information" => $ms->barang->information
                ],
                'quantity' => $ms->quantity,
                'sub_total' => $ms->sub_total
            ];
        }
        return
            [
                'id' => $this->id,
                'code_transaksi' => $this->code_transaksi,
                'kasir' => [
                    'id' => $this->admin->id,
                    'name' => $this->admin->name,
                    'email' => $this->admin->email,
                    'role' => $this->admin->role,
                ],
                'master' => $datame,
                'total' => $this->total,
                'created_at' => (string) $this->created_at,
                'updated_at' => (string) $this->updated_at,
            ];
    }
}
