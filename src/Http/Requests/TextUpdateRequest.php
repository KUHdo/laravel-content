<?php

namespace KUHdo\Content\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TextUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'lang' => ['sometimes', Rule::in(config('content.locales'))],
            'value' => ['sometimes', 'string']
        ];
    }
}
