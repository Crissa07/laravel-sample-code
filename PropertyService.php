<?php

namespace App\Services\Property;

use App\Models\Company;
use App\Models\Property;
use App\Repositories\Property\PropertyRepositoryInterface;
use App\Services\Base\BaseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Exception;

class PropertyService extends BaseService
{
    /**
     * @param  PropertyRepositoryInterface  $repository
     */
    public function __construct(PropertyRepositoryInterface $repository, private PropertyAuctionService $propertyAuctionService)
    {
        $this->repository = $repository;
    }

    /**
     * @param Company $company
     * @param array $data
     * @return Model
     * @throws Exception
     */
    public function store(Company $company, array $data)
    {
        DB::beginTransaction();
        try {
           $property = $this->repository->create(array_merge(['company_id' => $company->id, 'created_by' => Auth::user()->id], $data));
           $autionData = [
               'date' => null,
               'time' => null,
               'location' => null,
               'agents' => [],
           ];
           $this->propertyAuctionService->store($company, $property, $autionData);
            DB::commit();
            return $property;
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();
            throw $e;
        }
    }

    public function update(Company $company, Property $property, array $data)
    {
        DB::beginTransaction();
        try {
            $this->repository->update($data, $property);
            DB::commit();
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getPropertyList($request)
    {
        return $this->repository->getPropertyList($request);
    }

    /**
     * @param  Company  $company
     * @param  Property $property
     * @param  Request  $request
     * @return mixed
     */
    public function show(Company $company, Property $property, Request $request)
    {
        return  $this->repository->getProperty($property, $request);
    }
}
