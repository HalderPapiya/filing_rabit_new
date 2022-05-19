<?php

namespace App\Contracts;

/**
 * Interface AddOnBidContract
 * @package App\Contracts
 */
interface AddOnBidContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listAddOnBids(string $order = 'id', string $sort = 'desc', array $columns = ['*']);


    /**
     * @param int $id
     * @return mixed
     */
    public function findAddOnBidById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createAddOnBid(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateAddOnBid(array $params);

    /**
     * @param int $id
     * @return mixed
     */

    public function updateAddOnBidStatus(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteAddOnBid($id);
}