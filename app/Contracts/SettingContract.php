<?php

namespace App\Contracts;

/**
 * Interface interface SettingContract

 * @package App\Contracts
 */
interface SettingContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listSettings(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findSettingsById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createSettings(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateSettings(array $params);

    /**
     * @param int $id
     * @return mixed
     */

    public function updateSettingsStatus(array $params);
    /**
     * @param $id
     * @return bool
     */
    public function deleteSettings($id);
}