<?php

namespace App\Contracts;

/**
 * Interface BusinessAddOnContract
 * @package App\Contracts
 */
interface BusinessAddOnContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listBusinessAddOns(string $order = 'id', string $sort = 'desc', array $columns = ['*']);


    /**
     * @param int $id
     * @return mixed
     */
    public function findBusinessAddOnById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createBusinessAddOn(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateBusinessAddOn(array $params);

    /**
     * @param int $id
     * @return mixed
     */

    public function updateBusinessAddOnStatus(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteBusinessAddOn($id);
}