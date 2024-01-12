<?php

namespace App\Repositories\Property;

use App\Models\Property;
use Illuminate\Http\Request;

/**
 * Interface PropertyRepositoryInterface
 */
interface PropertyRepositoryInterface
{
    /**
     * @param $request
     * @return mixed
     */
    public function getPropertyList($request);
    /**
     * @param  Property  $property
     * @return int
     */
    public function getPropertyNextCount(Property $property): int;

    /**
     * @param  Property  $property
     * @return int
     */
    public function getPropertyBackCount(Property $property): int;

    /**
     * @return int
     */
    public function getPropertyCount(): int;

    /**
     * @param  Property  $property
     * @param  Request  $request
     * @return mixed
     */
    public function getProperty(Property $property, Request $request);
}
