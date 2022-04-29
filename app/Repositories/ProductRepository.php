<?php

namespace App\Repositories;

use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\ProductContract;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class ProductRepository
 *
 * @product \App\Repositories
 */
class ProductRepository extends BaseRepository implements ProductContract
{
    use UploadAble;

    /**
     * ProductRepository constructor.
     * @param Product $model
     */
    public function __construct(Product $model)
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
    public function listProducts(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findProductById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Product|mixed
     */
    public function createProduct(array $params)
    {
        try {
            $collection = collect($params);
            // dd($collection);

            $data = new Product;
            $data->category_id = $collection['categoryId'];
            $data->subCategory_id = $collection['subCategoryId'];
            $data->name = $collection['name'];
            $data->type_one_name = $collection['type_one_name'];
            $data->type_two_name = $collection['type_two_name'];
            $data->type_one_description = $collection['type_one_description'];
            $data->type_two_description = $collection['type_two_description'];
            $data->type_one_price = $collection['type_one_price'];
            $data->type_two_price = $collection['type_two_price'];
            $data_image = $collection['image'];
            $imageName = time() . "." . $data_image->getClientOriginalName();
            $data_image->move("uploads/product/", $imageName);
            $uploadedImage = $imageName;
            $data->image = $uploadedImage;


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
    public function updateProduct(array $params)
    {
        // $data = $this->findProductById($params['id']);
        // $collection = collect($params)->except('_token');

        $data = $this->findProductById($params['id']);
        $collection = collect($params)->except('_token');

        $data->category_id = $collection['categoryId'];
        $data->subCategory_id = $collection['subCategoryId'];
        $data->name = $collection['name'];
        $data->type_one_name = $collection['type_one_name'];
        $data->type_two_name = $collection['type_two_name'];
        $data->type_one_description = $collection['type_one_description'];
        $data->type_two_description = $collection['type_two_description'];
        $data->type_one_price = $collection['type_one_price'];
        $data->type_two_price = $collection['type_two_price'];
        if (isset($collection['image'])) {
            $data_image = $collection['image'];
            $imageName = time() . "." . $data_image->getClientOriginalName();
            $data_image->move("uploads/product/", $imageName);
            $uploadedImage = $imageName;
            $data->image = $uploadedImage;
        };

        $data->save();

        return $data;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteProduct($id)
    {
        $data = $this->findProductById($id);
        $data->delete();
        return $data;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateProductStatus(array $params)
    {
        $data = $this->findProductById($params['id']);
        $collection = collect($params)->except('_token');
        $data->status = $collection['status'];
        $data->save();

        return $data;
    }
}