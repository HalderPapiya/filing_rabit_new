<?php

namespace App\Repositories;

use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\PackageContract;
use App\Models\Package;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class PackageRepository
 *
 * @package \App\Repositories
 */
class PackageRepository extends BaseRepository implements PackageContract
{
    use UploadAble;

    /**
     * PackageRepository constructor.
     * @param Package $model
     */
    public function __construct(Package $model)
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
    public function listPackages(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findPackageById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Package|mixed
     */
    public function createPackage(array $params)
    {
        try {
            $collection = collect($params);
            // dd($collection);

            $data = new Package;
            $data->title = $collection['title'];
            $data->price = $collection['price'];

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
    public function updatePackage(array $params)
    {
        $data = $this->findPackageById($params['id']);
        $collection = collect($params)->except('_token');

        $data->title = $collection['title'];
        $data->price = $collection['price'];
        //$category->status = $collection['status'];

        $data->save();

        return $data;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deletePackage($id)
    {
        $data = $this->findPackageById($id);
        $data->delete();
        return $data;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updatePackageStatus(array $params)
    {
        $data = $this->findPackageById($params['id']);
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