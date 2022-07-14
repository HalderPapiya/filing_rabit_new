<?php

namespace App\Contracts;

/**
 * Interface CategoryContract
 * @package App\Contracts
 */
interface IndustriesServeContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listIndustriesServes(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findIndustriesServeById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createIndustriesServe(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateIndustriesServe(array $params);

    /**
     * @param int $id
     * @return mixed
     */

    public function updateIndustriesServeStatus(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteIndustriesServe($id);
}