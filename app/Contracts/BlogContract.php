<?php

namespace App\Contracts;

/**
 * Interface CategoryContract
 * @package App\Contracts
 */
interface BlogContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listBlogs(string $order = 'id', string $sort = 'desc', array $columns = ['*']);
    public function latestBlog(string $order = 'id', string $sort = 'desc', array $columns = ['*']);
    /**
     * @param int $id
     * @return mixed
     */
    public function findBlogById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createBlog(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateBlog(array $params);

    /**
     * @param int $id
     * @return mixed
     */

    public function updateBlogStatus(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteBlog($id);
}
