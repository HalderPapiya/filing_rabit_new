<?php

namespace App\Repositories;

use App\Models\Process;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\ProcessContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class ProcessContract
 *
 * @package \App\Repositories
 */
class ProcessRepository extends BaseRepository implements ProcessContract
{
    use UploadAble;

    /**
     * ProcessRepository constructor.
     * @param Process $model
     */
    public function __construct(Process $model)
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
    public function listProcess(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findProcessById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Process|mixed
     */
    public function createProcess(array $params)
    {
        try {
            $collection = collect($params);

            $data = new Process;
            $data->title = $collection['title'];
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
    public function updateProcess(array $params)
    {
        $data = $this->findProcessById($params['id']);
        $collection = collect($params)->except('_token');

        $data->title = $collection['title'];
        $data->description = $collection['description'];

        $data->save();

        return $data;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteProcess($id)
    {
        $data = $this->findProcessById($id);
        $data->delete();
        return $data;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateProcessStatus(array $params)
    {
        $data = $this->findProcessById($params['id']);
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