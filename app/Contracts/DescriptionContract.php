<?php

namespace App\Contracts;

/**
 * Interface CategoryContract
 * @package App\Contracts
 */
interface DescriptionContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listDescriptions(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findDescriptionById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createDescription(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateDescription(array $params);

    /**
     * @param int $id
     * @return mixed
     */

    public function updateDescriptionStatus(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteDescription($id);
}