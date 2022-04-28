<?php

namespace App\Repositories;

use App\Models\AboutUs;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\AboutUsContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class BannerRepository
 *
 * @package \App\Repositories
 */
class AboutUsRepository extends BaseRepository implements AboutUsContract
{
    use UploadAble;

    /**
     * AboutUsRepository constructor.
     * @param AboutUs $model
     */
    public function __construct(AboutUs $model)
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
    public function listAboutUs(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findAboutUsById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return AboutUs|mixed
     */
    public function createAboutUs(array $params)
    {
        try {



            $collection = collect($params);

            $data = new AboutUs;
            $data->title = $collection['title'];
            $data->description = $collection['description'];


            $image1 = $collection['image1'];
            $imageName = time() . "." . $image1->getClientOriginalName();
            $image1->move("uploads/about_us/", $imageName);
            $uploadedImage = $imageName;
            $data->image1 = $uploadedImage;


            $image2 = $collection['image2'];
            $imageName = time() . "." . $image2->getClientOriginalName();
            $image2->move("uploads/about_us/", $imageName);
            $uploadedImage = $imageName;
            $data->image2 = $uploadedImage;

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
    public function updateAboutUs(array $params)
    {
        $data = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');


        $data->title = $collection['title'];
        $data->description = $collection['description'];

        if (isset($collection['image1'])) {
            $image1 = $collection['image1'];
            $imageName = time() . "." . $image1->getClientOriginalName();
            $image1->move("uploads/about_us/", $imageName);
            $uploadedImage = $imageName;
            $data->image1 = $uploadedImage;
        }

        if (isset($collection['image2'])) {
            $image2 = $collection['image2'];
            $imageName = time() . "." . $image2->getClientOriginalName();
            $image2->move("uploads/about_us/", $imageName);
            $uploadedImage = $imageName;
            $data->image2 = $uploadedImage;
        }
        $data->save();

        return $data;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteAboutUs($id)
    {
        $data = $this->findOneOrFail($id);
        $data->delete();
        return $data;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateAboutUsStatus(array $params)
    {
        $data = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $data->status = $collection['status'];
        $data->save();

        return $data;
    }
}