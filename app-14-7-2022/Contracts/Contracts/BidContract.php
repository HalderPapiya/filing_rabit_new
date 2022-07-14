<?php

namespace App\Contracts;

/**
 * Interface BidContract
 * @package App\Contracts
 */
interface BidContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listBids(string $order = 'id', string $sort = 'desc', array $columns = ['*']);


    /**
     * @param int $id
     * @return mixed
     */
    public function findBidById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createBid(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateBid(array $params);

    /**
     * @param int $id
     * @return mixed
     */

    public function updateBidStatus(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteBid($id);
}