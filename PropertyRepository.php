<?php

namespace App\Repositories\Property;

use App\Models\Property;
use App\Repositories\Base\BaseRepository;
use Illuminate\Http\Request;

final class PropertyRepository extends BaseRepository implements PropertyRepositoryInterface
{
    /**
     * @param  Property  $model
     */
    public function __construct(Property $model)
    {
        parent::__construct($model);
    }

    public function getPropertyList($request)
    {
        $columnArray = ['id', 'name'];
        $ascArray = ['desc', 'asc'];

        $query = $this->model::query();

        if ($request->search) {
            $query->where('address', 'like', '%'.$request->search.'%');
            $query->orWhere('suburb', 'like', '%'.$request->search.'%');
            $query->orWhere('state', 'like', '%'.$request->search.'%');
            $query->orWhere('pass_code', 'like', '%'.$request->search.'%');
        }
        $query->with('createdBy');

        if ($request->column && $request->dir && in_array($request->column, $columnArray) && in_array($request->dir, $ascArray)) {
            $query = $query->orderBy($request->column, $request->dir);
        } else {
            $query = $query->orderBy('id', 'desc');
        }

        $pageSize = 10;
        if ($request->length) {
            $pageSize = $request->length;
        }

        return $query->paginate($pageSize);
    }

    /**
     * @param  Property  $property
     * @return int
     */
    public function getPropertyNextCount(Property $property): int
    {
        return $this->model::where('id', '>', $property->id)->count();
    }

    /**
     * @param  Property  $property
     * @return int
     */
    public function getPropertyBackCount(Property $property): int
    {
        return $this->model::where('id', '<', $property->id)->count();
    }

    /**
     * @return int
     */
    public function getPropertyCount(): int
    {
        return $this->model::count();
    }

    /**
     * @param  Property  $property
     * @param  Request  $request
     * @return Property|mixed
     */
    public function getProperty(Property $property, Request $request)
    {
        $newProperty = null;
        $get = $request->get('get');
        if ($get) {
            if ($get == 'next') {
                $newProperty = $this->model::where('id', '>', $property->id)->first();
            } else {
                $newProperty = $this->model::where('id', '<', $property->id)->orderBy('id', 'DESC')->first();
            }
        } else {
            $newProperty = $property->load('createdBy','propertykeyDetail','PropertyMarketing','PropertyMarketingLink', 'contactProperties');
        }
        $newProperty->back_count = $this->getPropertyBackCount($newProperty);
        $newProperty->next_count = $this->getPropertyNextCount($newProperty);
        $newProperty->count = $this->getPropertyCount();

        return $newProperty;
    }
}
