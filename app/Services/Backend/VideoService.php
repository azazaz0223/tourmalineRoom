<?php

namespace App\Services\Backend;

use App\Repositories\VideoRepository;

class VideoService
{
    public function __construct(
        private VideoRepository $videoRepository
    ) {
    }

    public function findOne()
    {
        return $this->videoRepository->findOne();
    }

    public function upsert($request)
    {
        return $this->videoRepository->upsert($request);
    }
}
