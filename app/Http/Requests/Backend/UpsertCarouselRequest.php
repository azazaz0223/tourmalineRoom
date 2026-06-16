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
            "updateContents.*" => "nullable|string",
            "updateImages.*" => "nullable|image|mimes:jpeg,png,jpg|dimensions:width=1920,height=750",
            "updateContentTexts.*" => "nullable|string",
            "updateContentImages.*" => "nullable|image|mimes:jpeg,png,jpg|dimensions:width=1920,height=750",
            "titles.*" => "nullable|string",
            "subtitles.*" => "nullable|string",
            "contents.*" => "nullable|string",
            "images.*" => "nullable|image|mimes:jpeg,png,jpg|dimensions:width=1920,height=750",
            "contentTexts.*" => "nullable|string",
            "contentImages.*" => "nullable|image|mimes:jpeg,png,jpg|dimensions:width=1920,height=750",
            "deletes.*" => "nullable|string",
        ];
    }
}
