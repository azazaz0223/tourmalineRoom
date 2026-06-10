<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\BaseRequest;


class UpdateBlogRequest extends BaseRequest
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
            "keyword" => "required|string",
            "content" => "string",
            'image' => 'nullable|image|dimensions:width=1200,height=800',
        ];
    }
}
