<?php

namespace App\Repositories;

use App\Traits\UploadAble;
use App\Contracts\TestimonialContract;
use App\Models\Testimonial;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class TestimonialRepository
 *
 * @package \App\Repositories
 */
class TestimonialRepository extends BaseRepository implements TestimonialContract
{
    use UploadAble;

    /**
     * TestimonialRepository constructor.
     * @param Testimonial $model
     */
    public function __construct(Testimonial $model)
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
    public function listTestimonials(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findTestimonialById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Testimonial|mixed
     */
    public function CreateTestimonial(array $params)
    {
        try {
            $collection = collect($params);
            // dd($collection);

            $data = new Testimonial();
            $data->description = $collection['description'];

            $data_image = $collection['image'];
            $imageName = time() . "." . $data_image->getClientOriginalName();
            $data_image->move("uploads/testimonial/", $imageName);
            $uploadedImage = $imageName;
            $data->image = $uploadedImage;

            //$category->status = $collection['status'];

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
    public function updateTestimonial(array $params)
    {
        $data = $this->findTestimonialById($params['id']);
        $collection = collect($params)->except('_token');

        $data->description = $collection['description'];


        if (isset($collection['image'])) {
            $data_image = $collection['image'];
            $imageName = time() . "." . $data_image->getClientOriginalName();
            $data_image->move("uploads/testimonial/", $imageName);
            $uploadedImage = $imageName;
            $data->image = $uploadedImage;
        }
        //$category->status = $collection['status'];

        $data->save();

        return $data;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteTestimonial($id)
    {
        $data = $this->findTestimonialById($id);
        $data->delete();
        return $data;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateTestimonialStatus(array $params)
    {
        $data = $this->findTestimonialById($params['id']);
        $collection = collect($params)->except('_token');
        $data->status = $collection['status'];
        $data->save();

        return $data;
    }
}