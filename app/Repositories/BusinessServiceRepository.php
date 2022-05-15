<?php

namespace App\Repositories;

use App\Models\BusinessService;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Contracts\BusinessServiceContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class BusinessServiceRepository
 *
 * @package \App\Repositories
 */
class BusinessServiceRepository extends BaseRepository implements BusinessServiceContract
{
    use UploadAble;

    /**
     * BusinessServiceRepository constructor.
     * @param BusinessService $model
     */
    public function __construct(BusinessService $model)
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
    public function listBusinessServices(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }


    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findBusinessServiceById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }


    public function createBusinessServices(array $params)
    {
        try {
            $collection = collect($params);

            $BusinessService = new BusinessService;
            $BusinessService->name = $collection['name'];
            $BusinessService->user_id = Auth::user()->id;
            $BusinessService->type_id = $collection['type_id'];
            $BusinessService->valuation = $collection['valuation'];


            // $businessService_image = $collection['image'];
            // $imageName = time() . "." . $businessService_image->getClientOriginalName();
            // $businessService_image->move("uploads/BusinessService/", $imageName);
            // $uploadedImage = $imageName;
            // $BusinessService->image = $uploadedImage;

            //$category->status = $collection['status'];
            // dd($BusinessService);
            $BusinessService->save();
            return $BusinessService;
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function updateBusinessService(array $params)
    {

        $BusinessService = $this->findBusinessServiceById($params['id']);
        $collection = collect($params)->except('_token');
        $BusinessService = new BusinessService;
        $BusinessService->name = $collection['name'];
        $BusinessService->user_id = Auth::user()->id;
        $BusinessService->type_id = $collection['type_id'];
        $BusinessService->valuation = $collection['valuation'];

        $BusinessService->save();

        return $BusinessService;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteBusinessService($id)
    {
        $BusinessService = $this->findBusinessServiceById($id);
        $BusinessService->delete();
        return $BusinessService;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateBusinessServiceStatus(array $params)
    {
        $BusinessService = $this->findBusinessServiceById($params['id']);
        $collection = collect($params)->except('_token');
        $BusinessService->status = $collection['status'];
        $BusinessService->save();

        return $BusinessService;
    }
}