<?php

namespace KUHdo\Content\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContentStoreRequest extends FormRequest
{
    
    public function rules(): array
    {
        return [
            'key' => 'sometimes|string',
            'texts' => 'required|array',
            'texts.*.lang' => 'required|string',
            'texts.*.value' => 'required|string',
            'contentable_type' => 'required|string',
            'contentable_id' => 'required|int'
        ];
    }
}
