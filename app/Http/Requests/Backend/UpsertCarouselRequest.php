<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\BaseRequest;


class UpsertCarouselRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "updateIds.*" => "nullable|string",
            "updateTitles.*" => "nullable|string",
            "updateSubtitles.*" => "nullable|string",
            "updateButtonTexts.*" => "nullable|string",
            "updateContentTypes.*" => "nullable|in:0,1",
            "updateContents.*" => "nullable|string",
            "updateImages.*" => "nullable|image|mimes:jpeg,png,jpg|dimensions:width=1920,height=750",
            "updateContentTexts.*" => "nullable|string",
            "updateContentImages.*" => "nullable|image|mimes:jpeg,png,jpg|dimensions:width=1920,height=750",
            "updateUrls.*" => "nullable|string",
            "titles.*" => "nullable|string",
            "subtitles.*" => "nullable|string",
            "buttonTexts.*" => "nullable|string",
            "contentTypes.*" => "nullable|in:0,1",
            "contents.*" => "nullable|string",
            "images.*" => "nullable|image|mimes:jpeg,png,jpg|dimensions:width=1920,height=750",
            "contentTexts.*" => "nullable|string",
            "contentImages.*" => "nullable|image|mimes:jpeg,png,jpg|dimensions:width=1920,height=750",
            "urls.*" => "nullable|string",
            "deletes.*" => "nullable|string",
        ];
    }
}
