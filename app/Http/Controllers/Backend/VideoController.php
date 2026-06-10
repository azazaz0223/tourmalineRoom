<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UpsertVideoRequest;
use App\Services\Backend\VideoService;

class VideoController extends Controller
{
    public function __construct(
        private VideoService $videoService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->videoService->findOne();
        return view('backend.video.list', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function upsert(UpsertVideoRequest $request)
    {
        $this->videoService->upsert($request);

        return $this->successResponse(null, 200);
    }
}
