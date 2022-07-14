<?php

namespace App\Repositories;

use App\Models\Blog;
use App\Traits\UploadAble;
use App\Contracts\BlogContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class BlogRepository
 *
 * @package \App\Repositories
 */
class BlogRepository extends BaseRepository implements BlogContract
{
    use UploadAble;

    /**
     * BlogRepository constructor.
     * @param Blog $model
     */
    public function __construct(Blog $model)
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
    public function listBlogs(string $order = 'id', string $sort = 'asc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }
    public function latestBlog(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->model::orderBy('id', 'desc')->limit(2)->get();
    }
    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findBlogById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Blog|mixed
     */
    public function createBlog(array $params)
    {
        try {
            $collection = collect($params);
            // dd($collection);

            $blog = new Blog;
            $blog->title = $collection['title'];
            $blog->description = $collection['description'];

            $blog_image = $collection['image'];
            $imageName = time() . "." . $blog_image->getClientOriginalName();
            $blog_image->move("uploads/blog/", $imageName);
            $uploadedImage = $imageName;
            $blog->image = $uploadedImage;

            //$category->status = $collection['status'];

            $blog->save();

            return $blog;
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateBlog(array $params)
    {
        $blog = $this->findBlogById($params['id']);
        $collection = collect($params)->except('_token');

        $blog->title = $collection['title'];
        $blog->description = $collection['description'];

        // $blog_image = $collection['image'];
        // $imageName = time() . "." . $blog_image->getClientOriginalName();
        // $blog_image->move("uploads/blog/", $imageName);
        // $uploadedImage = $imageName;
        // $blog->image = $uploadedImage;

        if (isset($collection['image'])) {
            $blog_image = $collection['image'];
            $imageName = time() . "." . $blog_image->getClientOriginalName();
            $blog_image->move("uploads/blog/", $imageName);
            $uploadedImage = $imageName;
            $blog->image = $uploadedImage;
        }
        //$category->status = $collection['status'];

        $blog->save();

        return $blog;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteBlog($id)
    {
        $blog = $this->findBlogById($id);
        $blog->delete();
        return $blog;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateBlogStatus(array $params)
    {
        $blog = $this->findBlogById($params['id']);
        $collection = collect($params)->except('_token');
        $blog->status = $collection['status'];
        $blog->save();

        return $blog;
    }

    /**
     * @param string $slug
     * @return mixed
     */
    // public function getShowsBySlug($slug)
    // {
    //     return Category::where('slug', $slug)->with('shows')->get();
    // }
}