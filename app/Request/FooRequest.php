<?php

declare(strict_types=1);

namespace App\Request;

class FooRequest extends BaseRequest
{

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
        ];
    }

    /**
     * @return string[]
     */
    public function attributes(): array
    {
        return [
             "title"=>"文章标题",
        ];
    }
}
