<?php

namespace App\Repositories;

use App\Models\WhyUs;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\WhyUsContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class CategoryRepository
 *
 * @package \App\Repositories
 */
class WhyUsRepository extends BaseRepository implements WhyUsContract
{
    use UploadAble;

    /**
     * CategoryRepository constructor.
     * @param WhyUs $model
     */
    public function __construct(WhyUs $model)
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
    public function listWhyUs(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findWhyUsById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return WhyUs|mixed
     */
    public function createWhyUs(array $params)
    {
        try {
            $collection = collect($params);
            // dd($collection);

            $whyUs = new WhyUs;
            $whyUs->title = $collection['title'];
            $whyUs->description = $collection['description'];

            $why_us_image = $collection['image'];
            $imageName = time() . "." . $why_us_image->getClientOriginalName();
            $why_us_image->move("uploads/blog/", $imageName);
            $uploadedImage = $imageName;
            $whyUs->image = $uploadedImage;

            //$category->status = $collection['status'];

            $whyUs->save();

            return $whyUs;
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateWhyUs(array $params)
    {
        $whyUs = $this->findWhyUsById($params['id']);
        $collection = collect($params)->except('_token');

        $whyUs->title = $collection['title'];
        //$category->status = $collection['status'];

        $whyUs->description = $collection['description'];

        $why_us_image = $collection['image'];
        $imageName = time() . "." . $why_us_image->getClientOriginalName();
        $why_us_image->move("uploads/blog/", $imageName);
        $uploadedImage = $imageName;
        $whyUs->image = $uploadedImage;

        $whyUs->save();

        return $whyUs;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteWhyUs($id)
    {
        $whyUs = $this->findWhyUsById($id);
        $whyUs->delete();
        return $whyUs;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateWhyUsStatus(array $params)
    {
        $whyUs = $this->findWhyUsById($params['id']);
        $collection = collect($params)->except('_token');
        $whyUs->status = $collection['status'];
        $whyUs->save();

        return $whyUs;
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