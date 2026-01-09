<?php

namespace Hzmwdz\TinyTax\Support;

use Illuminate\Support\Facades\Lang;

class TransHelper
{
    /**
     * @var string
     */
    protected static $name = 'tiny-tax';

    /**
     * @param string $name
     * @return string
     */
    public static function taxAlreadyExists($name)
    {
        $key = static::$name . '::messages.tax_already_exists';

        return Lang::get($key, ['name' => $name]);
    }

    /**
     * @param int $id
     * @return string
     */
    public static function taxNotFound($id)
    {
        $key = static::$name . "::messages.tax_not_found";

        return Lang::get($key, ['id' => $id]);
    }
}
