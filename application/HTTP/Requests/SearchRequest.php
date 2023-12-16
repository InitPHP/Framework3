<?php

namespace App\HTTP\Requests;

use InitPHP\Framework\HTTP\FormRequest;

class SearchRequest extends FormRequest
{

    protected function prepare()
    {
    }

    protected function rules(): array
    {
        return [
            'search'        => 'required',
        ];
    }

}
