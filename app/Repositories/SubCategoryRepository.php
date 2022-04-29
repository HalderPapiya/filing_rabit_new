<?php

namespace App\Repositories;

use App\Models\SubCategory;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\SubCategoryContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class SubCategoryRepository
 *
 * @package \App\Repositories
 */
class SubCategoryRepository extends BaseRepository implements SubCategoryContract
{
    use UploadAble;

    /**
     * SubCategoryRepository constructor.
     * @param SubCategory $model
     */
    public function __construct(SubCategory $model)
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
    public function listSubCategories(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    // public function listCategories(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    // {
    //     return $this->all($columns, $order, $sort);
    // }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findSubCategoryById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Category|mixed
     */
    public function createSubCategory(array $params)
    {
        try {
            $collection = collect($params);
            // dd($collection);

            $subCategory = new SubCategory;
            $subCategory->title = $collection['title'];
            // $subCategory->categoryId = $collection['category_id'];
            $subCategory->category_id = $collection['categoryId'];
            //$category->status = $collection['status'];

            $subCategory->save();

            return $subCategory;
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateSubCategory(array $params)
    {
        $subCategory = $this->findSubCategoryById($params['id']);
        $collection = collect($params)->except('_token');

        $subCategory->title = $collection['title'];
        $subCategory->category_id = $collection['categoryId'];
        //$category->status = $collection['status'];

        $subCategory->save();

        return $subCategory;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteSubCategory($id)
    {
        $subCategory = $this->findSubCategoryById($id);
        $subCategory->delete();
        return $subCategory;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateSubCategoryStatus(array $params)
    {
        $subCategory = $this->findSubCategoryById($params['id']);
        $collection = collect($params)->except('_token');
        $subCategory->status = $collection['status'];
        $subCategory->save();

        return $subCategory;
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