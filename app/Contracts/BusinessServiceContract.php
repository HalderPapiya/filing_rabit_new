<?php

namespace App\Contracts;

/**
 * Interface BusinessServiceContract
 * @package App\Contracts
 */
interface BusinessServiceContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listBusinessServices(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

}