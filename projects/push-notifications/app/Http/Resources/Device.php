<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Device extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'token' => $this->token,
            'locale' => $this->getLocaleText(),
            'environment' => $this->getModeText(),
            'updatedAt' => $this->getUpdatedText()
        ];
    }

    function getLocaleText()
    {
        return $this->locale === config('variables.locale_cn') ?
            'CN' : 'EN';
    }

    function getModeText()
    {
        return $this->environment === config('variables.sandbox') ?
            'Sandbox' : 'Production';
    }
    function getUpdatedText()
    {
        return $this->updated_at->toDateTimeString();
    }
}
