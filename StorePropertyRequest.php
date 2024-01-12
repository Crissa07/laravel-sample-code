<?php

namespace App\Http\Requests\Property;

use App\Http\Resources\Property\PropertyDetailResource;
use App\Http\Resources\Property\PropertyResource;
use App\Models\Property;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePropertyRequest extends FormRequest
{
    private $propertyData;
    public function rules()
    {
        return [
            'property_type' => ['required', 'string', Rule::in(array_keys(Property::propertyTypes()))],
            'property_status' => ['required', 'string', Rule::in(array_keys(Property::propertyStatus()))],
            'listed_type' => ['required', 'string', Rule::in(array_keys(Property::ListedTypes()))],
            'unit_no' => 'nullable|max:200',
            'street_no' => 'required|max:200',
            'street_name' => 'required|max:200',
            'address' => 'required',
            'suburb' => 'required|max:200',
            'state' => 'nullable|max:200',
            'pass_code' => 'nullable|max:200',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (! $this->validateDuplicateProperty()) {
                $validator->errors()->add('property_duplicate', new PropertyResource($this->propertyData));
            }
        });
    }

    private function validateDuplicateProperty()
    {
       $property = Property::where('address', $this->address)->first();

       if ($property) {
           $this->propertyData = $property;
           return false;
       }
       return true;


    }
}
