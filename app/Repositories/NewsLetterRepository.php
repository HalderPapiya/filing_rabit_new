<?php

namespace App\Repositories;

use App\Models\NewsLetter;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\NewsLetterContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class NewsLetterRepository
 *
 * @package \App\Repositories
 */
class NewsLetterRepository extends BaseRepository implements NewsLetterContract
{
    use UploadAble;

    /**
     * NewsLetterRepository constructor.
     * @param NewsLetter $model
     */
    public function __construct(NewsLetter $model)
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
    public function listNewsLetters(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findNewsLetterById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return NewsLetter|mixed
     */
    public function createNewsLetter(array $params)
    {
        try {
            $collection = collect($params);
            $NewsLetter = new NewsLetter;
            $NewsLetter->name = $collection['name'];
            $NewsLetter->email = $collection['email'];

            $NewsLetter->save();

            return $NewsLetter;
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateNewsLetter(array $params)
    {
        $NewsLetter = $this->findNewsLetterById($params['id']);
        $collection = collect($params)->except('_token');

        $NewsLetter->title = $collection['title'];
        //$NewsLetter->status = $collection['status'];

        $NewsLetter->save();

        return $NewsLetter;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteNewsLetter($id)
    {
        $NewsLetter = $this->findNewsLetterById($id);
        $NewsLetter->delete();
        return $NewsLetter;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateNewsLetterStatus(array $params)
    {
        $NewsLetter = $this->findNewsLetterById($params['id']);
        $collection = collect($params)->except('_token');
        $NewsLetter->status = $collection['status'];
        $NewsLetter->save();

        return $NewsLetter;
    }

    /**
     * @param string $slug
     * @return mixed
     */
    // public function getShowsBySlug($slug)
    // {
    //     return NewsLetter::where('slug', $slug)->with('shows')->get();
    // }
}