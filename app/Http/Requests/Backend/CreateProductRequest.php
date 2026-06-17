<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\BaseRequest;


class CreateProductRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "title" => "required|string",
            "subtitle" => "nullable|string",
            "content" => "nullable|string",
            "status" => "required|in:0,1",
            "sort" => "nullable|integer|min:1",
            "image" => "required|image|mimes:jpeg,png,jpg|dimensions:width=1200,height=800",
            "content_image" => "nullable|image|mimes:jpeg,png,jpg",
        ];
    }
}
