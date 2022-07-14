<?php

namespace App\Contracts;

/**
 * Interface TestimonialContract
 * @package App\Contracts
 */
interface TestimonialContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listTestimonials(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findTestimonialById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createTestimonial(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateTestimonial(array $params);

    /**
     * @param int $id
     * @return mixed
     */

    public function updateTestimonialStatus(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteTestimonial($id);
}