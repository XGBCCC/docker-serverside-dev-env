<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RsaKey extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'public' => $this->public,
            'version' => $this->version
        ];
    }
}
