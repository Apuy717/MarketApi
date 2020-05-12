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
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'price_in' => $this->price_in,
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
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
        ];
    }
}
