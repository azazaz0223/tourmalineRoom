<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;
use Schema;

class AboutSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        About::truncate();
        About::create([
            'zh_title' => '中文標題',
            'en_title' => '英文標題',
            'content' => '內容',
            'image1' => 'images/about/1.jpg',
            'image1_title' => '圖片一標題',
            'image1_content' => '圖片一內文',
            'image1_content_image' => 'images/about/1.jpg',
            'image2' => 'images/about/2.jpg',
            'image2_title' => '圖片二標題',
            'image2_content' => '圖片二內文',
            'image2_content_image' => 'images/about/2.jpg',
            'image3' => 'images/about/3.jpg',
            'image3_title' => '圖片三標題',
            'image3_content' => '圖片三內文',
            'image3_content_image' => 'images/about/3.jpg',
        ]);
        Schema::enableForeignKeyConstraints();
    }
}
