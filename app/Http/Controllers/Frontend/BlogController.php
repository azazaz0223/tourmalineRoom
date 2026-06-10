<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Services\Backend\BlogService;

class BlogController extends Controller
{
    public function __construct(
        private BlogService $blogService,
    ) {
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view("frontend.blog", ['blog' => $blog]);
    }
}
