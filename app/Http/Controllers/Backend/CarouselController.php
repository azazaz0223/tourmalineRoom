<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UpdateLogoRequest;
use App\Http\Requests\Backend\UpsertCarouselRequest;
use App\Services\Backend\CarouselService;
use App\Services\Backend\UploadImageService;

class CarouselController extends Controller
{
    public function __construct(
        private CarouselService $carouselService,
        private UploadImageService $uploadImageService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = $this->carouselService->findAll();
        return view("backend.carousel.list", ["list" => $list]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateLogo(UpdateLogoRequest $request)
    {
        $this->uploadImageService->uploadLogo($request->file('logo'));

        return $this->successResponse(null, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function upsert(UpsertCarouselRequest $request)
    {
        if (isset($request['deletes'])) {
            foreach ($request['deletes'] as $value) {
                try {
                    $this->uploadImageService->deleteImage($value, 'carousel');
                    $this->carouselService->delete($value);
                } catch (\Throwable $th) {
                    throw $th;
                }
            }
        }

        if (isset($request['updateIds'])) {
            $updateImages = $request->file('updateImages');

            if ($request->hasFile('updateContentImages')) {
                $updateContentImages = $request->file('updateContentImages');
            }

            foreach ($request['updateIds'] as $key => $value) {
                try {
                    $data = [
                        "title" => $request['updateTitles'][$key],
                        "subtitle" => $request['updateSubtitles'][$key],
                        "button_text" => $request['updateButtonTexts'][$key],
                        "content_type" => $request['updateContentTypes'][$key],
                        "content" => $request['updateContentTypes'][$key] == 0 ? $request['updateContents'][$key] : null,
                        "content_text" => $request['updateContentTypes'][$key] == 0 ? $request['updateContentTexts'][$key] : null,
                        "url" => $request['updateContentTypes'][$key] == 1 ? $request['updateUrls'][$key] : null
                    ];

                    $this->carouselService->update($request['updateIds'][$key], $data);

                    if (isset($updateImages[$key]) && $updateImages[$key]->isValid()) {
                        $this->uploadImageService->uploadImage($request['updateIds'][$key], 'carousel', $updateImages[$key]);
                    }

                    if (isset($updateContentImages[$key]) && $updateContentImages[$key]->isValid()) {
                        $content_image_url = $this->uploadImageService->uploadImage($request['updateIds'][$key] . "content", 'carousel', $updateContentImages[$key]);
                        $this->carouselService->update($request['updateIds'][$key], ["content_image" => $content_image_url]);
                    }
                } catch (\Throwable $th) {
                    throw $th;
                }
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request['images'] as $key => $value) {
                try {
                    $data = [
                        "title" => $request['titles'][$key],
                        "subtitle" => $request['subtitles'][$key],
                        "button_text" => $request['buttonTexts'][$key],
                        "content_type" => $request['contentTypes'][$key],
                        "content" => $request['contentTypes'][$key] == 0 ? $request['contents'][$key] : null,
                        "content_text" => $request['contentTypes'][$key] == 0 ? $request['contentTexts'][$key] : null,
                        "url" => $request['contentTypes'][$key] == 1 ? $request['urls'][$key] : null
                    ];

                    $carousel = $this->carouselService->create($data);

                    $image_url = $this->uploadImageService->uploadImage($carousel->id, 'carousel', $request['images'][$key]);
                    $this->carouselService->updateImageUrl($carousel->id, $image_url);

                    if (isset($request['contentImages'][$key]) && $request['contentImages'][$key]->isValid()) {
                        $content_image_url = $this->uploadImageService->uploadImage($carousel->id . "content", 'carousel', $request['contentImages'][$key]);
                        $this->carouselService->update($carousel->id, ["content_image" => $content_image_url]);
                    }

                } catch (\Throwable $th) {
                    throw $th;
                }
            }
        }

        return $this->successResponse(null, 200);
    }
}
