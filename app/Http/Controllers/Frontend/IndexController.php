<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CreateContactRequest;
use App\Services\Backend\AboutService;
use App\Services\Backend\BlogService;
use App\Services\Backend\CarouselService;
use App\Services\Backend\ContactService;
use App\Services\Backend\VideoService;
use App\Services\Backend\NewsService;
use App\Services\Backend\ProductService;

class IndexController extends Controller
{
    public function __construct(
        private CarouselService $carouselService,
        private AboutService $aboutService,
        private NewsService $newsService,
        private ProductService $productService,
        private BlogService $blogService,
        private ContactService $contactService,
        private VideoService $videoService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        $data['carousels'] = $this->carouselService->findAllForFront();
        $data['about'] = $this->aboutService->findOne();
        $data['news'] = $this->newsService->findAllForFront();
        $data['products'] = $this->productService->findAllForFront();
        $data['blogs'] = $this->blogService->findAllForFront();
        $data['video'] = $this->videoService->findOne();
        return view('frontend.index', ['data' => $data]);
    }

    public function getBlogs()
    {
        $data = [];
        $data['blogs'] = $this->blogService->findAllForFront();
        return $this->successResponse(view('frontend.blog-list', compact('data'))->render(), 200);
    }

    public function storeContact(CreateContactRequest $request)
    {
        $this->contactService->create($request->all());

        return $this->successResponse(null, 200);
    }
}
