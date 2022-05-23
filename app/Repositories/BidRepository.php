<?php

namespace App\Repositories;

use App\Models\Bid;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Contracts\BidContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class BidRepository
 *
 * @package \App\Repositories
 */
class BidRepository extends BaseRepository implements BidContract
{
    use UploadAble;

    /**
     * BidRepository constructor.
     * @param Bid $model
     */
    public function __construct(Bid $model)
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
    public function listBids(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }


    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findBidById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }


    public function createBid(array $params)
    {
        try {
            $collection = collect($params);
            // $exist = Bid::where('user_id', $collection['user_id'])->exists();
            // if (!$exist) {
                $Bid = new Bid;
                $Bid->user_id = Auth::user()->id;
                $Bid->business_id =  $collection['business_id'];
                $Bid->valuation = $collection['valuation'];
                $Bid->save();
                return $Bid;
            // }
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function updateBid(array $params)
    {

        $Bid = $this->findBidById($params['id']);
        $collection = collect($params)->except('_token');
        $Bid = new Bid;
        $Bid->user_id = Auth::user()->id;
        $Bid->business_id =  $collection['business_id'];
        $Bid->valuation = $collection['valuation'];

        $Bid->save();

        return $Bid;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteBid($id)
    {
        $Bid = $this->findBidById($id);
        $Bid->delete();
        return $Bid;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateBidStatus(array $params)
    {
        $Bid = $this->findBidById($params['id']);
        $collection = collect($params)->except('_token');
        $Bid->status = $collection['status'];
        $Bid->save();

        return $Bid;
    }
}