<?php

namespace App\Repositories;

use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\BusinessTypeContract;
use App\Models\BusinessType;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class BusinessTypeRepository
 *
 * @BusinessType \App\Repositories
 */
class BusinessTypeRepository extends BaseRepository implements BusinessTypeContract
{
    use UploadAble;

    /**
     * BusinessTypeRepository constructor.
     * @param BusinessType $model
     */
    public function __construct(BusinessType $model)
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
    public function listBusinessTypes(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findBusinessTypeById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return BusinessType|mixed
     */
    public function createBusinessType(array $params)
    {
        try {
            $collection = collect($params);
            // dd($collection);

            $data = new BusinessType;
            $data->name = $collection['name'];

            $data->save();

            return $data;
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateBusinessType(array $params)
    {
        $data = $this->findBusinessTypeById($params['id']);
        $collection = collect($params)->except('_token');

        $data->name = $collection['name'];
        //$category->status = $collection['status'];

        $data->save();

        return $data;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteBusinessType($id)
    {
        $data = $this->findBusinessTypeById($id);
        $data->delete();
        return $data;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateBusinessTypeStatus(array $params)
    {
        $data = $this->findBusinessTypeById($params['id']);
        $collection = collect($params)->except('_token');
        $data->status = $collection['status'];
        $data->save();

        return $data;
    }

    /**
     * @param string $slug
     * @return mixed
     */
    // public function getShowsBySlug($slug)
    // {
    //     return Category::where('slug', $slug)->with('shows')->get();
    // }
}