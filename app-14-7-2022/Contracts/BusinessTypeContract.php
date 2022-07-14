<?php

namespace App\Contracts;

/**
 * Interface BusinessTypeContract
 * @BusinessType App\Contracts
 */
interface BusinessTypeContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listBusinessTypes(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findBusinessTypeById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createBusinessType(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateBusinessType(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteBusinessType($id);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateBusinessTypeStatus(array $params);
}