<?php

namespace KUHdo\Content\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContentUpdateRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'key' => 'sometimes|string',
        ];
    }
}
