<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'firstname' => $this->firstname,
            'lastname'=> $this->lastname,
            'phone'=> $this->phone,
            'email'=> $this->email,
            'birthday'=> $this->birthday,
            'signed_up_the'=> $this->signed_up_the,
        ];
    }
}
