<?php

namespace App\Contracts;

/**
 * Interface CategoryContract
 * @package App\Contracts
 */
interface ProductContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listProducts(string $order = 'id', string $sort = 'desc', array $columns = ['*']);
    public function listProductsDescription();
    /**
     * @param int $id
     * @return mixed
     */
    public function findProductById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createProduct(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateProduct(array $params);

    /**
     * @param int $id
     * @return mixed
     */

    public function updateProductStatus(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteProduct($id);
}