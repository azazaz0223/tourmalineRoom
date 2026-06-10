<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CreateBlogRequest;
use App\Http\Requests\Backend\UpdateBlogRequest;
use App\Http\Requests\Backend\UploadAboutImageRequest;
use App\Models\Blog;
use App\Services\Backend\BlogService;
use App\Services\Backend\UploadImageService;

class BlogController extends Controller
{
    public function __construct(
        private BlogService $blogService,
        private UploadImageService $uploadImageService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = $this->blogService->findAll();
        return view('backend.blog.list', ['list' => $list]);
    }

    public function create()
    {
        return view("backend.blog.create");
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view("backend.blog.detail", ['blog' => $blog]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateBlogRequest $request)
    {
        $data = [
            "title" => $request['title'],
            "keyword" => $request['keyword'],
            "content" => $request['content'],
        ];

        $blog = $this->blogService->create($data);

        $image_url = $this->uploadImageService->uploadImage($blog->id, 'blog', $request->file('image'));
        $this->blogService->update($blog->id, ["image" => $image_url]);

        return $this->successResponse(null, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $data = [
            "title" => $request['title'],
            "keyword" => $request['keyword'],
            "content" => $request['content'],
        ];

        $this->blogService->update($blog->id, $data);

        if (isset($request['image'])) {
            $image_url = $this->uploadImageService->uploadImage($blog->id, 'blog', $request->file('image'));
            $this->blogService->update($blog->id, ["image" => $image_url]);
        }

        return $this->successResponse(null, 200);
    }

    public function destroy(Blog $blog)
    {
        $this->uploadImageService->deleteImage($blog->id, 'blog');
        $this->blogService->delete($blog->id);

        return $this->successResponse(null, 200);
    }
}
