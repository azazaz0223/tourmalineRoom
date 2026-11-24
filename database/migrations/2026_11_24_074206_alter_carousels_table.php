<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('carousels', function (Blueprint $table) {
            $table->string('button_text', 255)->nullable()->comment('按鈕文字')->after('subtitle');
            $table->tinyInteger('content_type')->default(0)->comment('內文狀態 0:有內文 1:超連結')->after('button_text');
            $table->string('url', 2048)->nullable()->comment('跳轉網址')->after('content_text');
        });
    }

    public function down(): void
    {
        Schema::table('carousels', function (Blueprint $table) {
            $table->dropColumn(['button_text', 'content_type', 'url',]);
        });
    }
};