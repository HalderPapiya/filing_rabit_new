<?php

namespace App\Repositories;

use App\Models\BusinessService;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
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
    
}