<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Country extends JsonResource {
    
    public function toArray($request) {
        return parent::toArray($request);
    }
}
