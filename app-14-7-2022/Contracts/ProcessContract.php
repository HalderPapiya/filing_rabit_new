<?php

namespace App\Contracts;

/**
 * Interface Process
 * @package App\Contracts
 */
interface processContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listProcess(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findProcessById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createProcess(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateProcess(array $params);

    /**
     * @param int $id
     * @return mixed
     */

    public function updateProcessStatus(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteProcess($id);
}