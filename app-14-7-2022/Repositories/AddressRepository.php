<?php

namespace App\Repositories;

use App\Models\Address;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\AddressContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Auth;

/**
 * Class AddressContract
 *
 * @package \App\Repositories
 */
class AddressRepository extends BaseRepository implements AddressContract
{
    use UploadAble;

    /**
     * AddressRepository constructor.
     * @param Address $model
     */
    public function __construct(Address $model)
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
    public function listAddresses(string $order = 'id', string $sort = 'asc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findAddressById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Address|mixed
     */
    public function createAddress(array $params)
    {
        // return "here";
        

        try {
            $collection = collect($params);

            $data = new Address;
            $data->user_id = Auth::guard('user')->user()->id;
            $data->ip = $this->ip;
            $data->fName = $collection['first_name'];
            $data->lName = $collection['last_name'];
            $data->company_name = $collection['company_name'];
            $data->country = $collection['country'];
            $data->street = $collection['street'];
            $data->house_no = $collection['house_no'];
            $data->state = $collection['state'];
            $data->city = $collection['city'];
            $data->pin = $collection['pin_code'];
            $data->phone = $collection['mobile'];
            $data->email = $collection['email'];

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
    public function updateAddress(array $params)
    {
        $data = $this->model::where('user_id', Auth::guard('user')->user())->findOrFail('id');
        // $data = Address::where('user_id', Auth::guard('user')->user()->id)->find('id');
        // dd($data);
        $collection = collect($params)->except('_token');

        $data->user_id = Auth::guard('user')->user()->id;
        $data->ip = $this->ip;
        $data->fName = $collection['first_name'];
        $data->lName = $collection['last_name'];
        $data->company_name = $collection['company_name'];
        $data->country = $collection['country'];
        $data->street = $collection['street'];
        $data->house_no = $collection['house_no'];
        $data->state = $collection['state'];
        $data->city = $collection['city'];
        $data->pin = $collection['pin_code'];
        $data->phone = $collection['mobile'];
        $data->email = $collection['email'];;
        // dd($data);
        return $data;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteAddress($id)
    {
        $data = $this->findAddressById($id);
        $data->delete();
        return $data;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateAddressStatus(array $params)
    {
        $data = $this->findAddressById($params['id']);
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