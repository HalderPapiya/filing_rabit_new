<?php

namespace App\Contracts;

/**
 * Interface AddressContract
 * @package App\Contracts
 */
interface AddressContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listAddresses(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findAddressById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createAddress(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateAddress(array $params);

    /**
     * @param int $id
     * @return mixed
     */

    public function updateAddressStatus(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteAddress($id);
}