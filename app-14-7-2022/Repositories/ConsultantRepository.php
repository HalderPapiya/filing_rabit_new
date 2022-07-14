<?php

namespace App\Repositories;

use App\Models\Consultant;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\ConsultantContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class ConsultantRepository
 *
 * @package \App\Repositories
 */
class ConsultantRepository extends BaseRepository implements ConsultantContract
{
    use UploadAble;

    /**
     * ConsultantRepository constructor.
     * @param Consultant $model
     */
    public function __construct(Consultant $model)
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
    public function listConsultants(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findConsultantById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Consultant|mixed
     */
    public function createConsultant(array $params)
    {
        try {
            $collection = collect($params);
            $Consultant = new Consultant;
            $Consultant->name = $collection['name'];
            $Consultant->email = $collection['email'];
            $Consultant->phone = $collection['phone'];
            $Consultant->city = $collection['city'];
            // $Consultant->email = $collection['email'];

            $Consultant->save();

            return $Consultant;
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateConsultant(array $params)
    {
        $Consultant = $this->findConsultantById($params['id']);
        $collection = collect($params)->except('_token');

        $Consultant->name = $collection['name'];
        $Consultant->email = $collection['email'];
        $Consultant->phone = $collection['phone'];
        $Consultant->city = $collection['city'];
        $Consultant->save();

        return $Consultant;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteConsultant($id)
    {
        $Consultant = $this->findConsultantById($id);
        $Consultant->delete();
        return $Consultant;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateConsultantStatus(array $params)
    {
        $Consultant = $this->findConsultantById($params['id']);
        $collection = collect($params)->except('_token');
        $Consultant->status = $collection['status'];
        $Consultant->save();

        return $Consultant;
    }

    /**
     * @param string $slug
     * @return mixed
     */
    // public function getShowsBySlug($slug)
    // {
    //     return Consultant::where('slug', $slug)->with('shows')->get();
    // }
}