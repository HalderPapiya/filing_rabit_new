<?php

namespace App\Contracts;

/**
 * Interface BusinessServiceContract
 * @package App\Contracts
 */
interface BusinessServiceContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listBusinessServices(string $order = 'id', string $sort = 'desc', array $columns = ['*']);


    /**
     * @param int $id
     * @return mixed
     */
    public function findBusinessServiceById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createBusinessServices(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateBusinessService(array $params);

    /**
     * @param int $id
     * @return mixed
     */

    public function updateBusinessServiceStatus(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteBusinessService($id);
}