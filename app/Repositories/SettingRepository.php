<?php

namespace App\Repositories;

use App\Models\Setting;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\SettingContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class BannerRepository
 *
 * @package \App\Repositories
 */
class SettingRepository extends BaseRepository implements SettingContract
{
    use UploadAble;

    /**
     * SettingRepository constructor.
     * @param Setting $model
     */
    public function __construct(Setting $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listSettings(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    public function privacyPolicy(string $order = 'id', array $columns = ['*'])
    {
        return $this->model::where('key', 'privacy_policy')->orderBy('id', 'asc')->get();
    }

    public function termsConditions(string $order = 'id', array $columns = ['*'])
    {
        return $this->model::where('key', 'terms_and_conditions')->orderBy('id', 'asc')->get();
    }

    public function refundPolicy(string $order = 'id', array $columns = ['*'])
    {
        return $this->model::where('key', 'refund_policy')->orderBy('id', 'asc')->get();
    }

    public function disclaimerPolicy(string $order = 'id', array $columns = ['*'])
    {
        return $this->model::where('key', 'disclaimer_policy')->orderBy('id', 'asc')->get();
    }
    public function confidentialStatement(string $order = 'id', array $columns = ['*'])
    {
        return $this->model::where('key', 'confidential_statement')->orderBy('id', 'asc')->get();
    }

    public function listFaqs(string $order = 'id', array $columns = ['*'])
    {
        return $this->model::where('key', 'faq')->get();
    }
    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findSettingsById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Setting|mixed
     */
    public function createSettings(array $params)
    {
        try {

            $collection = collect($params);

            $data = new Setting;
            $data->title = $collection['title'];
            $data->product_id = $collection['product_id'];
            $data->description = $collection['description'];
            $data->key = $collection['key'];

            $data->save();

            return $data;
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateSettings(array $params)
    {
        $data = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');


        $data->title = $collection['title'];
        $data->description = $collection['description'];
        $data->key = $collection['key'];
        $data->save();

        return $data;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteSettings($id)
    {
        $data = $this->findOneOrFail($id);
        $data->delete();
        return $data;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateSettingsStatus(array $params)
    {
        $data = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $data->status = $collection['status'];
        $data->save();

        return $data;
    }
}
