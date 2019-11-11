<?php
/**
 * Project      : Auto JWT
 * File Name    : User.php
 * Author       : Abu Bakar Siddique
 * Email        : absiddique.live@gmail.com
 * Date[Y/M/D]  : 2019/07/17 1:19 PM
 */

namespace TunnelConflux\AutoJWT\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            "name"          => $this->name ?? null,
            "email"         => $this->email ?? null,
            "phone"         => $this->phone ?? ($this->phone_number ?? null),
            "registered_at" => $this->created_at ?? null,
            "verified_at"   => $this->email_verified_at ?? null,
        ];
    }
}