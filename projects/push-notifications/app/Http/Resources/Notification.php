<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Notification extends JsonResource
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
            'title' => $this->title,
            'body' => $this->body,
            'sound' => $this->getSoundText(),
            'badge' => $this->badge,
            'environment' => $this->getEnvrionmentText(),
            'pushedAt' => $this->getPushedDateText()
        ];
    }

    function getSoundText()
    {
        switch ($this->sound) {
            case config('variables.system_sound'):
                return 'System default';
            case config('variables.jingle_bell'):
                return 'Jingle bell';
        }

        return 'System default';
    }

    function getEnvrionmentText()
    {
        return $this->environment === config('variables.sandbox') ? 'Sandbox' : 'Production';
    }

    function getPushedDateText()
    {
        return $this->created_at->toDateTimeString();
    }
}
