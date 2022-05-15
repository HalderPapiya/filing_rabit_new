<?php

namespace App\Repositories;

use App\Models\BusinessAddOn;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Contracts\BusinessAddOnContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class BusinessAddOnRepository
 *
 * @package \App\Repositories
 */
class BusinessAddOnRepository extends BaseRepository implements BusinessAddOnContract
{
    use UploadAble;

    /**
     * BusinessAddOnRepository constructor.
     * @param BusinessAddOn $model
     */
    public function __construct(BusinessAddOn $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listBusinessAddOns(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }


    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findBusinessAddOnById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }


    public function createBusinessAddOn(array $params)
    {
        try {
            $collection = collect($params);

            $BusinessAddOn = new BusinessAddOn;
            $BusinessAddOn->name = $collection['name'];
            // $BusinessAddOn->user_id = Auth::user()->id;
            $BusinessAddOn->business_id = $collection['business_id'];
            $BusinessAddOn->valuation = $collection['valuation'];

            $BusinessAddOn->save();
            return $BusinessAddOn;
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function updateBusinessAddOn(array $params)
    {

        $BusinessAddOn = $this->findBusinessAddOnById($params['id']);
        $collection = collect($params)->except('_token');
        $BusinessAddOn = new BusinessAddOn;
        $BusinessAddOn->name = $collection['name'];
        // $BusinessAddOn->user_id = Auth::user()->id;
        $BusinessAddOn->business_id = $collection['business_id'];
        $BusinessAddOn->valuation = $collection['valuation'];

        $BusinessAddOn->save();

        return $BusinessAddOn;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteBusinessAddOn($id)
    {
        $BusinessAddOn = $this->findBusinessAddOnById($id);
        $BusinessAddOn->delete();
        return $BusinessAddOn;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateBusinessAddOnStatus(array $params)
    {
        $BusinessAddOn = $this->findBusinessAddOnById($params['id']);
        $collection = collect($params)->except('_token');
        $BusinessAddOn->status = $collection['status'];
        $BusinessAddOn->save();

        return $BusinessAddOn;
    }
}