<?php

namespace App\Repositories;

use App\Models\BidAddOn;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Contracts\AddOnBidContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class AddOnBidRepository
 *
 * @package \App\Repositories
 */
class AddOnBidRepository extends BaseRepository implements AddOnBidContract
{
    use UploadAble;

    /**
     * AddOnBidRepository constructor.
     * @param BidAddOn $model
     */
    public function __construct(BidAddOn $model)
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
    public function listAddOnBids(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }


    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findAddOnBidById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }


    public function createAddOnBid(array $params)
    {
        try {
            $collection = collect($params);

            $AddOnBid = new BidAddOn;
            // $AddOnBid->name = $collection['name'];
            $AddOnBid->user_id = Auth::user()->id;
            $AddOnBid->business_id = $collection['business_id'];
            $AddOnBid->add_on_id = $collection['add_on_id'];
            $AddOnBid->valuation = $collection['valuation'];

            $AddOnBid->save();
            return $AddOnBid;
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function updateAddOnBid(array $params)
    {

        $AddOnBid = $this->findAddOnBidById($params['id']);
        $collection = collect($params)->except('_token');
        $AddOnBid = new BidAddOn;
        $AddOnBid->user_id = Auth::user()->id;
        $AddOnBid->business_id =  $collection['business_id'];
        $AddOnBid->valuation = $collection['valuation'];

        $AddOnBid->save();

        return $AddOnBid;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteAddOnBid($id)
    {
        $AddOnBid = $this->findAddOnBidById($id);
        $AddOnBid->delete();
        return $AddOnBid;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateAddOnBidStatus(array $params)
    {
        $AddOnBid = $this->findAddOnBidById($params['id']);
        $collection = collect($params)->except('_token');
        $AddOnBid->status = $collection['status'];
        $AddOnBid->save();

        return $AddOnBid;
    }
}