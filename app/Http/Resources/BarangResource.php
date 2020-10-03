<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class BarangResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if (count($this->suppilerBarang) > 0)
            foreach ($this->suppilerBarang as $dts) {
                // $dataSup[] = $dts->suppiler->company;
                $dataSup[] = ['ceo' => $dts->suppiler->name, 'company' => $dts->suppiler->company];
            }
        else {
            $dataSup[] = ['empty'];
        }
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'price_in' => $this->price_in,
            'price_seller' => $this->price_seller,
            'price_members' => $this->price_members,
            'price_out' => $this->price_out,
            'expired' => $this->expired,
            'stock' => $this->stock,
            'unit' => [
                'id' => $this->unit->id,
                'unit' => $this->unit->unit,
                'created_at' => (string) $this->unit->created_at,
                'updated_at' => (string) $this->unit->updated_at,
            ],
            'category' => [
                'id' => $this->category->id,
                'category' => $this->category->category,
                'created_at' => (string) $this->category->created_at,
                'updated_at' => (string) $this->category->updated_at,

            ],
            'status' => $this->status,
            'information' =>  $this->information,
            'suppiler' => $dataSup,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
        ];
    }
}
