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
                    "price_in" => $ms->barang->price_in,
                    "price_seller" => $ms->barang->price_seller,
                    "price_members" => $ms->barang->price_members,
                    "price_out" => $ms->barang->price_out,
                    "category" => $ms->barang->category->category,
                    "unit" => $ms->barang->unit->unit,
                    "expired" => $ms->barang->expired,
                    "information" => $ms->barang->information
                ],
                'quantity' => $ms->quantity,
                'sub_total' => $ms->sub_total
            ];

            $incomeSeller[] =  ($ms->barang->price_seller - $ms->barang->price_in) * $ms->quantity;
            $incomeMembers[] =  ($ms->barang->price_members - $ms->barang->price_in) * $ms->quantity;
            $incomeUmum[] =  ($ms->barang->price_out - $ms->barang->price_in) * $ms->quantity;
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
                'members' => $this->members,
                'master' => $datame,
                'total' => $this->total,
                'incomeSeller' => array_sum($incomeSeller),
                'incomeMembers' => array_sum($incomeMembers),
                'incomeUmum' => array_sum($incomeUmum),
                'created_at' => (string) $this->created_at,
                'updated_at' => (string) $this->updated_at,
            ];
    }
}
