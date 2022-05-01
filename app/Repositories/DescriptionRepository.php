<?php

namespace App\Repositories;

use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\DescriptionContract;
use App\Models\Description;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class DescriptionRepository
 *
 * @Description \App\Repositories
 */
class DescriptionRepository extends BaseRepository implements DescriptionContract
{
    use UploadAble;

    /**
     * DescriptionRepository constructor.
     * @param Description $model
     */
    public function __construct(Description $model)
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
    public function listDescriptions(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }
    public function productWiseDescriptions(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        // $desId = $this->findOneOrFail($params['id']);
        // return $this->model::where('product_id','id')->get($columns, $order, $sort);
        return $this->model::with('productDetails')->get();
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findDescriptionById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Description|mixed
     */
    public function createDescription(array $params)
    {
        try {
            $collection = collect($params);
            // dd($collection);

            $data = new Description;
            $data->product_id = $collection['productId'];
            $data->description = $collection['description'];
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
    public function updateDescription(array $params)
    {
        $data = $this->findDescriptionById($params['id']);
        $collection = collect($params)->except('_token');

        $data->product_id = $collection['productId'];
        $data->description = $collection['description'];
        $data->save();

        return $data;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteDescription($id)
    {
        $data = $this->findDescriptionById($id);
        $data->delete();
        return $data;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateDescriptionStatus(array $params)
    {
        $data = $this->findDescriptionById($params['id']);
        $collection = collect($params)->except('_token');
        $data->status = $collection['status'];
        $data->save();

        return $data;
    }
}