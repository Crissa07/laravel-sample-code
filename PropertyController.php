<?php

namespace App\Http\Controllers\Api\Property;

use App\Http\Controllers\Base\BaseController;
use App\Http\Requests\Property\StorePropertyRequest;
use App\Http\Requests\Property\UpdatePropertyRequest;
// use App\Http\Resources\Contact\ContactDetailResource;
use App\Http\Resources\Property\PropertyDetailResource;
use App\Http\Resources\Property\PropertyResourceCollection;
use App\Models\Company;
use App\Models\Property;
use App\Services\Property\PropertyService;
use Illuminate\Http\Request;




final class PropertyController extends BaseController
{
    /**
     * @param  PropertyService  $propertyService
     */
    public function __construct(private PropertyService $propertyService)
    {
    }

    /**
     *  /**
     * @OA\Get(
     * path="/company/{company}/property",
     * summary="List property",
     * description="",
     * operationId="get-list-property",
     * tags={"property"},
     * @OA\RequestBody(
     *    required=true,
     *    description="",
     *    @OA\JsonContent(
     *      @OA\Property(property="search", type="string",  example="test@gmail.com"),
     *      @OA\Property(property="length", type="string",  example="10"),
     *      @OA\Property(property="page", type="string",  example="1"),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="property list Successfull",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="{'status':'Success','message':'Property list','data':{'list':[{'id':2,'property_type':'required|max:200','property_status':'required|max:200','listed_type':'required|max:200','unit_no':'unit 16','street_no':'street 1','street_name':'gilshan','address':null,'suburb':'required|max:200','state':'punbjab','pass_code':'34','created_by':{'id':1,'first_name':'hamad','last_name':'test','email':'test@gmail.com','companies':[{'id':1,'name':'hamad test','is_default':true}]},'created_at':'2023-03-29T17:28:40.000000Z','updated_at':'2023-03-29T17:28:40.000000Z'},{'id':1,'property_type':'required|max:200','property_status':'required|max:200','listed_type':'required|max:200','unit_no':'unit 15','street_no':'street 1','street_name':'gilshan','address':null,'suburb':'required|max:200','state':'punbjab','pass_code':'34','created_by':{'id':1,'first_name':'hamad','last_name':'test','email':'test@gmail.com','companies':[{'id':1,'name':'hamad test','is_default':true}]},'created_at':'2023-03-29T17:20:49.000000Z','updated_at':'2023-03-29T17:20:49.000000Z'}],'pagination':{'total':2,'count':2,'per_page':10,'current_page':1,'total_pages':1}}}"),
     * )
     *     )
     * )
     */
    public function index(Request $request, Company $company)
    {
        $data = new PropertyResourceCollection($this->propertyService->getPropertyList($request));

        return $this->successResponse('Property list', $data);
    }

    /**
     *  /**
     * @OA\Post(
     * path="/company/{company}/property",
     * summary="Create property",
     * description="",
     * operationId="create-property",
     * tags={"property"},
     * @OA\RequestBody(
     *    required=true,
     *    description="",
     *    @OA\JsonContent(
     *       required={"property_status", "listed_type","unit_no","street_no", "street_no", "street_name", "suburb", "state", "pass_code", "address"},
     *      @OA\Property(property="property_status", type="string",  example="pipeline"),
     *      @OA\Property(property="listed_type", type="string",  example="pipeline"),
     *      @OA\Property(property="property_type", type="string",  example="pipeline"),
     *       @OA\Property(property="unit_no", type="string", example="40"),
     *       @OA\Property(property="street_no", type="string", format="phone_number", example="40"),
     *       @OA\Property(property="street_name", type="string", format="phone_number", example="test"),
     *       @OA\Property(property="suburb", type="string", format="phone_number", example="suburb"),
     *       @OA\Property(property="state", type="string", format="phone_number", example="state"),
     *       @OA\Property(property="pass_code", type="string", format="phone_number", example="23"),
     *       @OA\Property(property="address", type="string", format="phone_number", example="address"),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Property Created Successfull",
     *    @OA\JsonContent(
     *       @OA\Property(property="status", type="string", example="true"),
     *       @OA\Property(property="message", type="string", example="Property Created Successfully"),
     * )
     *     )
     * )
     */
    public function store(StorePropertyRequest $request, Company $company)
    {
        $property = $this->propertyService->store($company, $request->validated());

        return $this->successResponse('property add successfully', ['id' => $property->id]);
    }

    /**
     *  /**
     * @OA\Get(
     * path="/company/{company}/property/{property_id}",
     * summary="property detail",
     * description="",
     * operationId="get-detail-property",
     * tags={"property"},
     * @OA\Response(
     *    response=200,
     *    description="property detail",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="{'status':'Success','message':'Property','data':{'id':1,'property_type':'required|max:200','property_status':'required|max:200','listed_type':'required|max:200','unit_no':'unit 15','street_no':'street 1','street_name':'gilshan','address':null,'suburb':'required|max:200','state':'punbjab','pass_code':'34','created_by':{'id':1,'first_name':'hamad','last_name':'test','email':'test@gmail.com','companies':[{'id':1,'name':'hamad test','is_default':true}] ,'next_count':0,'back_count':0,'count':1 },'created_at':'2023-03-29T17:20:49.000000Z','updated_at':'2023-03-29T17:20:49.000000Z'}}"),
     * )
     *     )
     * )
     */
    public function show(Company $company, Property $property , Request $request)
    {
        $data = new PropertyDetailResource($this->propertyService->show($company, $property, $request));

        return $this->successResponse('Property', $data);
    }

    /**
     *  /**
     * @OA\Put(
     * path="/company/{company}/property/{property_id}",
     * summary="Update property",
     * description="",
     * operationId="update-property",
     * tags={"property"},
     * @OA\RequestBody(
     *    required=true,
     *    description="",
     *    @OA\JsonContent(
     *       required={"property_status", "listed_type","unit_no","street_no", "street_no", "street_name", "suburb", "state", "pass_code", "address"},
     *      @OA\Property(property="property_status", type="string",  example="pipeline"),
     *      @OA\Property(property="listed_type", type="string",  example="pipeline"),
     *      @OA\Property(property="property_type", type="string",  example="pipeline"),
     *       @OA\Property(property="unit_no", type="string", example="40"),
     *       @OA\Property(property="street_no", type="string", format="phone_number", example="40"),
     *       @OA\Property(property="street_name", type="string", format="phone_number", example="test"),
     *       @OA\Property(property="suburb", type="string", format="phone_number", example="suburb"),
     *       @OA\Property(property="state", type="string", format="phone_number", example="state"),
     *       @OA\Property(property="pass_code", type="string", format="phone_number", example="23"),
     *       @OA\Property(property="address", type="string", format="phone_number", example="address"),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Property update Successfull",
     *    @OA\JsonContent(
     *       @OA\Property(property="status", type="string", example="true"),
     *       @OA\Property(property="message", type="string", example="Property update Successfully"),
     * )
     *     )
     * )
     */
    public function update(UpdatePropertyRequest $request, Company $company, Property $property)
    {
        $this->propertyService->update($company, $property, $request->validated());

        return $this->successResponse('Property update successfully', []);

    }
}
