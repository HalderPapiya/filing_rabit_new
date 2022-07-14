<?php

namespace App\Contracts;

/**
 * Interface WhyUsContract
 * @package App\Contracts
 */
interface WhyUsContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listWhyUs(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findWhyUsById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createWhyUs(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateWhyUs(array $params);

    /**
     * @param int $id
     * @return mixed
     */

    public function updateWhyUsStatus(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteWhyUs($id);
}