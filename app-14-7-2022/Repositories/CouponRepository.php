<?php

namespace App\Repositories;

use App\Models\Coupon;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\CouponContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Auth;

/**
 * Class CouponContract
 *
 * @package \App\Repositories
 */
class CouponRepository extends BaseRepository implements CouponContract
{
    use UploadAble;

    /**
     * CouponRepository constructor.
     * @param Coupon $model
     */
    public function __construct(Coupon $model)
    {
        parent::__construct($model);
        $this->model = $model;
        $this->ip = $_SERVER['REMOTE_ADDR'];
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listCoupons(string $order = 'id', string $sort = 'asc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findCouponById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Coupon|mixed
     */
    public function createCoupon(array $params)
    {

        try {
            $collection = collect($params);

            $data = new Coupon;
            $data->name = $collection['name'];
            $data->coupon_code = $collection['coupon_code'];
            $data->amount = $collection['amount'];
            $data->max_time_of_use = $collection['max_time_of_use'];
            $data->max_time_one_can_use = $collection['max_time_one_can_use'];
            $data->no_of_usage = $collection['no_of_usage'];
            $data->start_date = $collection['start_date'];
            $data->end_date = $collection['end_date'];

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
    public function updateCoupon(array $params)
    {
        $data = $this->findCouponById($params['id']);
        $collection = collect($params)->except('_token');

        // $data->user_id = Auth::guard('user')->user()->id;
        // $data = new Coupon;
        $data->name = $collection['name'];
        $data->coupon_code = $collection['coupon_code'];
        $data->amount = $collection['amount'];
        $data->max_time_of_use = $collection['max_time_of_use'];
        $data->max_time_one_can_use = $collection['max_time_one_can_use'];
        $data->no_of_usage = $collection['no_of_usage'];
        $data->start_date = $collection['start_date'];
        $data->end_date = $collection['end_date'];

        $data->save();

        return $data;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteCoupon($id)
    {
        $data = $this->findCouponById($id);
        $data->delete();
        return $data;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateCouponStatus(array $params)
    {
        $data = $this->findCouponById($params['id']);
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