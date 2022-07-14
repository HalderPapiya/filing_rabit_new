<?php

namespace App\Contracts;

/**
 * Interface ContactUsContract
 * @package App\Contracts
 */
interface ContactUsContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listContactUs(string $order = 'id', string $sort = 'desc', array $columns = ['*']);
    public function latestContactUs(string $order = 'id', string $sort = 'desc', array $columns = ['*']);
    /**
     * @param int $id
     * @return mixed
     */
    public function findContactUsById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createContactUs(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateContactUs(array $params);

    /**
     * @param int $id
     * @return mixed
     */

    public function updateContactUsStatus(array $params);
    /**
     * @param $id
     * @return bool
     */
    public function deleteContactUs($id);
}
