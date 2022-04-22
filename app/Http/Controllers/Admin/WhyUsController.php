<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\WhyUsContract;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class WhyUsController extends BaseController
{
    /**
     * @var WhyUsContract
     */
    protected $whyUsRepository;

    /**
     * BlogController constructor.
     * 
     * @param WhyUsContract $whyUsRepository
     */
    public function __construct(WhyUsContract $whyUsRepository)
    {
        $this->whyUsRepository = $whyUsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = $this->whyUsRepository->listBlogs();
        // dd($blogs);
        $this->setPageTitle('Blog', 'List of all blogs');
        return view('admin.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->setPageTitle('Blog', 'Create Blog');
        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' =>  'required',
        ]);

        $params = $request->except('_token');

        $blog = $this->whyUsRepository->createBlog($params);

        if (!$blog) {
            return $this->responseRedirectBack('Error occurred while creating blog.', 'error', true, true);
        }
        return $this->responseRedirect('admin.blog.index', 'Blog has been added successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $blog = $this->whyUsRepository->findBlogById($id);

        $this->setPageTitle('Category', 'Edit Category : ' . $blog->title);
        return view('admin.blog.edit', compact('blog'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'title' =>  'required',
        ]);

        $params = $request->except('_token');

        //dd($params);

        $blog = $this->whyUsRepository->updateBlog($params);

        if (!$blog) {
            return $this->responseRedirectBack('Error occurred while updating blog.', 'error', true, true);
        }
        return $this->responseRedirectBack('Blog updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $blog = $this->whyUsRepository->deleteBlog($id);

        if (!$blog) {
            return $this->responseRedirectBack('Error occurred while deleting blog.', 'error', true, true);
        }
        return $this->responseRedirect('admin.blog.index', 'Blog deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $blog = $this->whyUsRepository->updateWhyUsStatus($params);

        if ($blog) {
            return response()->json(array('message' => 'Blog status successfully updated'));
        }
    }
}