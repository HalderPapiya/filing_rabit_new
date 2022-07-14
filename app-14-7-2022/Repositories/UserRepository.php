<?php

namespace App\Repositories;

use App\Models\User;
use App\Traits\UploadAble;
use App\Contracts\UserContract;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class UserRepository
 *
 * @package \App\Repositories
 */
class UserRepository extends BaseRepository implements UserContract
{
    use UploadAble;

    /**
     * UserRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
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
    public function listUsers(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findUserById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    // public function getUserDetails(int $id)
    // {
    //     try {
    //         $user =  Profile::select("profiles.*", "users.name as user_name", "users.id as userid", "users.is_block")
    //             ->leftjoin("users", "profiles.user_id", "=", "users.id")
    //             ->where('profiles.user_id', $id)
    //             ->get();
    //         //return $this->findOneOrFail($id);

    //         return $user;
    //     } catch (ModelNotFoundException $e) {

    //         throw new ModelNotFoundException($e);
    //     }
    // }

    /**
     * @param array $params
     * @return mixed
     */
    // public function blockUser($id, $is_block)
    // {
    //     $user = $this->findUserById($id);
    //     $user->is_block = $is_block;
    //     $user->save();

    //     return $user;
    // }
    /**
     * @param array $params
     * @return mixed
     */
    public function verify($id, $is_verified)
    {
        $user = $this->findUserById($id);
        $user->is_verified = $is_verified;
        $user->save();

        return $user;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateUserStatus(array $params)
    {
        $user = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $user->status = $collection['status'];
        $user->save();

        return $user;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteUser($id)
    {
        $user = $this->findOneOrFail($id);
        $user->delete();
        return $user;
    }
}