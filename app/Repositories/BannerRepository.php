<?php

namespace App\Repositories;

use App\Models\Banner;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\BannerContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class BannerRepository
 *
 * @package \App\Repositories
 */
class BannerRepository extends BaseRepository implements BannerContract
{
    use UploadAble;

    /**
     * BannerRepository constructor.
     * @param Banner $model
     */
    public function __construct(Banner $model)
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
    public function listBanners(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findBannerById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Banner|mixed
     */
    public function createBanner(array $params)
    {
        try {

            $collection = collect($params);

            $data = new Banner;
            $data->title = $collection['title'];
            $data->short_description = $collection['short_description'];

            $video = $collection['video'];
            $videoName = time() . "." . $video->getClientOriginalName();
            $video->move("uploads/banners/", $videoName);
            $uploadedVideo = $videoName;
            $data->video = $uploadedVideo;

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
    public function updateBanner(array $params)
    {
        $data = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $data->title = $collection['title'];
        $data->short_description = $collection['short_description'];
        if (isset($collection['video'])) {
            $video = $collection['video'];
            $videoName = time() . "." . $video->getClientOriginalName();
            $video->move("uploads/banners/", $videoName);
            $uploadedVideo = $videoName;
            $data->video = $uploadedVideo;
        }

        $data->save();

        return $data;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteBanner($id)
    {
        $data = $this->findOneOrFail($id);
        $data->delete();
        return $data;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateBannerStatus(array $params)
    {
        $data = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $data->status = $collection['status'];
        $data->save();

        return $data;
    }
}