<?php

namespace App\Contracts;

/**
 * Interface NewsLetterContract
 * @package App\Contracts
 */
interface NewsLetterContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listNewsLetters(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findNewsLetterById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createNewsLetter(array $params);
    /**
     * @param array $params
     * @return mixed
     */
    public function createEnquiry(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateNewsLetter(array $params);

    /**
     * @param int $id
     * @return mixed
     */

    public function updateNewsLetterStatus(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteNewsLetter($id);
}