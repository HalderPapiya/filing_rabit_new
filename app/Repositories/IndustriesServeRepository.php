<?php

namespace App\Repositories;

use App\Models\Blog;
use App\Traits\UploadAble;
use App\Contracts\IndustriesServeContract;
use App\Models\IndustriesServe;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class IndustriesServeRepository
 *
 * @package \App\Repositories
 */
class IndustriesServeRepository extends BaseRepository implements IndustriesServeContract
{
    use UploadAble;

    /**
     * IndustriesServeRepository constructor.
     * @param IndustriesServe $model
     */
    public function __construct(IndustriesServe $model)
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
    public function listIndustriesServes(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findIndustriesServeById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return IndustriesServe|mixed
     */
    public function CreateIndustriesServe(array $params)
    {
        try {
            $collection = collect($params);
            // dd($collection);

            $data = new IndustriesServe();
            $data->title = $collection['title'];

            $data_image = $collection['image'];
            $imageName = time() . "." . $data_image->getClientOriginalName();
            $data_image->move("uploads/industries_serve/", $imageName);
            $uploadedImage = $imageName;
            $data->image = $uploadedImage;

            //$category->status = $collection['status'];

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
    public function updateIndustriesServe(array $params)
    {
        $data = $this->findIndustriesServeById($params['id']);
        $collection = collect($params)->except('_token');

        $data->title = $collection['title'];

        // $data_image = $collection['image'];
        // $imageName = time() . "." . $data_image->getClientOriginalName();
        // $data_image->move("uploads/blog/", $imageName);
        // $uploadedImage = $imageName;
        // $data->image = $uploadedImage;

        if (isset($collection['image'])) {
            $data_image = $collection['image'];
            $imageName = time() . "." . $data_image->getClientOriginalName();
            $data_image->move("uploads/industries_serve/", $imageName);
            $uploadedImage = $imageName;
            $data->image = $uploadedImage;
        }
        //$category->status = $collection['status'];

        $data->save();

        return $data;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteIndustriesServe($id)
    {
        $data = $this->findIndustriesServeById($id);
        $data->delete();
        return $data;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateIndustriesServeStatus(array $params)
    {
        $data = $this->findIndustriesServeById($params['id']);
        $collection = collect($params)->except('_token');
        $data->status = $collection['status'];
        $data->save();

        return $data;
    }
}