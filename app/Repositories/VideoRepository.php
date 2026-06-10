<?php

namespace App\Repositories;

use App\Models\Video;

class VideoRepository
{
    public function findOne()
    {
        return Video::first();
    }

    /**
     * @return bool
     */
    public function upsert($request)
    {
        try {
            if (isset($request->id)) {
                $attributes = ['id' => $request->id];
            } else {
                $attributes = [];
            }

            Video::updateOrCreate($attributes, [
                'en_title' => $request->en_title,
                'zh_title' => $request->zh_title,
                'media_url' => $request->media_url,
            ]);

            return true;
        } catch (\Exception $e) {
            throw $e;
            return false;
        }
    }
}
