<?php

namespace App\Contracts;

/**
 * Interface SubCategoryContract
 * @package App\Contracts
 */
interface SubSubCategoryContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listSubSubCategories(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findSubSubCategoryById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createSubSubCategory(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateSubSubCategory(array $params);

    /**
     * @param int $id
     * @return mixed
     */

    public function updateSubSubCategoryStatus(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteSubSubCategory($id);
}