<?php

namespace KUHdo\Content\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TextStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'lang' => ['required', Rule::in(config('content.locales'))],
            'value' => ['required', 'string']
        ];
    }
}
