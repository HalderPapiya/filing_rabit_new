<?php

namespace App\Contracts;

/**
 * Interface BannerContract
 * @package App\Contracts
 */
interface BannerContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listBanners(string $order = 'id', string $sort = 'desc', array $columns = ['*']);
    public function latestBanner(string $order = 'id', string $sort = 'desc', array $columns = ['*']);
    /**
     * @param int $id
     * @return mixed
     */
    public function findBannerById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createBanner(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateBanner(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteBanner($id);

    /**
     * @param int $id
     * @return mixed
     */
    public function updateBannerStatus(array $params);
}
