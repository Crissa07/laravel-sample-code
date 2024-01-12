<?php

namespace App\Http\Resources\Property;

use App\Http\Resources\Contact\ContactPropertyResource;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\Property\PropertyKeyDetailResource;
use App\Http\Resources\Property\PropertyMarketingResource;
use App\Http\Resources\Property\PropertyMarketingLinkResource;

use Illuminate\Http\Resources\Json\JsonResource;


class PropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     *
     * @throws \Exception
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'property_type'             => $this->property_type,
            'property_status'           => $this->property_status,
            'listed_type'               => $this->listed_type,
            'unit_no'                   => $this->unit_no,
            'street_no'                 => $this->street_no,
            'street_name'               => $this->street_name,
            'address'                   => $this->address,
            'suburb'                    => $this->suburb,
            'state'                     => $this->state,
            'pass_code'                 => $this->pass_code,
            'created_by'                => new UserResource($this->createdBy),
            'created_at'                => $this->created_at,
            'updated_at'                => $this->updated_at
        ];
    }
}
