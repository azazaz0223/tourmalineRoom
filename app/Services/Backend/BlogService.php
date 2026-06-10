<?php

namespace App\Services\Backend;

use App\Repositories\BlogRepository;

class BlogService
{
    public function __construct(
        private BlogRepository $blogRepository
    ) {
    }

    public function findAllForFront()
    {
        return $this->blogRepository->findAllForFront();
    }

    public function findAll()
    {
        return $this->blogRepository->findAll();
    }

    public function create($request)
    {
        return $this->blogRepository->create($request);
    }

    public function update($id, $request)
    {
        return $this->blogRepository->update($id, $request);
    }

    public function updateImageUrl($id, $image)
    {
        return $this->blogRepository->updateImageUrl($id, $image);
    }

    public function delete($id)
    {
        return $this->blogRepository->delete($id);
    }
}
