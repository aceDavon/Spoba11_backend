<?php

namespace App\Http\Resources\api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => (string)$this->id,
            "attributes" => [
                "fullName" => $this->name,
                "username" => $this->username,
                "email" => $this->email,
                "member_since" => $this->created_at,
            ],
            "relations" => []
        ];
    }
}
