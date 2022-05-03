<?php

namespace App\Contracts;

/**
 * Interface ConsultantContract
 * @package App\Contracts
 */
interface ConsultantContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listConsultants(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findConsultantById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createConsultant(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateConsultant(array $params);

    /**
     * @param int $id
     * @return mixed
     */

    public function updateConsultantStatus(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteConsultant($id);
}