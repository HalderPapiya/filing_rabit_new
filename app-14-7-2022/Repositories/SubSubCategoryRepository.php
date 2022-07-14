<?php

namespace App\Repositories;

use App\Models\SubCategory;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\SubSubCategoryContract;
use App\Models\SubSubCategory;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class SubCategoryRepository
 *
 * @package \App\Repositories
 */
class SubSubCategoryRepository extends BaseRepository implements SubSubCategoryContract
{
    use UploadAble;

    /**
     * SubCategoryRepository constructor.
     * @param SubSubCategory $model
     */
    public function __construct(SubSubCategory $model)
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
    public function listSubSubCategories(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
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
    public function findSubSubCategoryById(int $id)
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
    public function createSubSubCategory(array $params)
    {
        try {
            $collection = collect($params);
            // dd($collection);

            $subCategory = new SubSubCategory;
            $subCategory->title = $collection['title'];
            // $subCategory->categoryId = $collection['category_id'];
            $subCategory->category_id = $collection['categoryId'];
            $subCategory->sub_category_id = $collection['subCategoryId'];
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
    public function updateSubSubCategory(array $params)
    {
        $subCategory = $this->findSubSubCategoryById($params['id']);
        $collection = collect($params)->except('_token');


        $subCategory = new SubSubCategory;
        $subCategory->title = $collection['title'];
        $subCategory->category_id = $collection['categoryId'];
        $subCategory->sub_category_id = $collection['subCategoryId'];

        $subCategory->save();

        return $subCategory;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteSubSubCategory($id)
    {
        $subCategory = $this->findSubSubCategoryById($id);
        $subCategory->delete();
        return $subCategory;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateSubSubCategoryStatus(array $params)
    {
        $subCategory = $this->findSubSubCategoryById($params['id']);
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