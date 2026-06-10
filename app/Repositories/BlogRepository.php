<?php

namespace App\Repositories;

use App\Models\Blog;

class BlogRepository
{
    public function findAllForFront()
    {
        return Blog::orderBy('id', 'desc')->paginate(4);
    }

    public function findAll()
    {
        return Blog::orderBy('id', 'desc')->paginate(20);
    }

    public function create($request)
    {
        try {
            return Blog::create($request);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function update($id, $request)
    {
        try {
            return Blog::where('id', $id)->update($request);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function updateImageUrl($id, $image)
    {
        try {
            Blog::where('id', $id)->update([
                'image' => $image
            ]);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function delete($id)
    {
        try {
            Blog::destroy($id);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
