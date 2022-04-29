<?php

namespace App\Contracts;

/**
 * Interface AboutUsContract
 * @package App\Contracts
 */
interface AboutUsContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listAboutUs(string $order = 'id', string $sort = 'desc', array $columns = ['*']);
    public function latestAboutUs(string $order = 'id', string $sort = 'desc', array $columns = ['*']);
    /**
     * @param int $id
     * @return mixed
     */
    public function findAboutUsById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createAboutUs(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateAboutUs(array $params);

    /**
     * @param int $id
     * @return mixed
     */

    public function updateAboutUsStatus(array $params);
    /**
     * @param $id
     * @return bool
     */
    public function deleteAboutUs($id);
}