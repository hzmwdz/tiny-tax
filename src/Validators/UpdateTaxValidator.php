<?php

namespace Hzmwdz\TinyTax\Validators;

use Illuminate\Support\Facades\Validator;

class UpdateTaxValidator
{
    /**
     * @param array $data
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public static function validate($data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'rate' => 'required|numeric|min:0',
        ])->validate();
    }
}
