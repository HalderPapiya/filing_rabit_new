<?php

namespace App\Repositories;

use App\Models\ContactUs;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\ContactUsContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class BannerRepository
 *
 * @package \App\Repositories
 */
class ContactUsRepository extends BaseRepository implements ContactUsContract
{
    use UploadAble;

    /**
     * ContactUsRepository constructor.
     * @param ContactUs $model
     */
    public function __construct(ContactUs $model)
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
    public function listContactUs(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    // public function latestContactUs(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    // {
    //     return $this->model::orderBy('id', 'desc')->first();
    // }
    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findContactUsById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return ContactUs|mixed
     */
    public function createContactUs(array $params)
    {
        try {



            $collection = collect($params);

            $data = new ContactUs;
            $data->title = $collection['title'];
            $data->email = $collection['email'];
            $data->address = $collection['address'];
            $data->sales_phone = $collection['sales_phone'];
            $data->support_phone = $collection['support_phone'];
            $data->facebook_link = $collection['facebook_link'];
            $data->twitter_link = $collection['twitter_link'];
            $data->instagram_link = $collection['instagram_link'];
            $data->pinterest_link = $collection['pinterest_link'];
            $data->youtube_link = $collection['youtube_link'];

            $image = $collection['image'];
            $imageName = time() . "." . $image->getClientOriginalName();
            $image->move("uploads/contact_us/", $imageName);
            $uploadedImage = $imageName;
            $data->image = $uploadedImage;


            $banner = $collection['banner'];
            $imageName = time() . "." . $banner->getClientOriginalName();
            $banner->move("uploads/contact_us/", $imageName);
            $uploadedImage = $imageName;
            $data->banner = $uploadedImage;

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
    public function updateContactUs(array $params)
    {
        $data = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');


        $data->title = $collection['title'];
        $data->email = $collection['email'];
        $data->address = $collection['address'];
        $data->sales_phone = $collection['sales_phone'];
        $data->support_phone = $collection['support_phone'];
        $data->facebook_link = $collection['facebook_link'];
        $data->twitter_link = $collection['twitter_link'];
        $data->instagram_link = $collection['instagram_link'];
        $data->pinterest_link = $collection['pinterest_link'];
        $data->youtube_link = $collection['youtube_link'];
        if (isset($collection['image'])) {
            $image = $collection['image'];
            $imageName = time() . "." . $image->getClientOriginalName();
            $image->move("uploads/contact_us/", $imageName);
            $uploadedImage = $imageName;
            $data->image = $uploadedImage;
        }

        if (isset($collection['banner'])) {
            $banner = $collection['banner'];
            $imageName = time() . "." . $banner->getClientOriginalName();
            $banner->move("uploads/contact_us/", $imageName);
            $uploadedImage = $imageName;
            $data->banner = $uploadedImage;
        }
        $data->save();

        return $data;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteContactUs($id)
    {
        $data = $this->findOneOrFail($id);
        $data->delete();
        return $data;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateContactUsStatus(array $params)
    {
        $data = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $data->status = $collection['status'];
        $data->save();

        return $data;
    }
}