<?php

namespace Hzmwdz\TinyTax\Support;

class CacheKeyHelper
{
    /**
     * @var string
     */
    protected static $prefix = 'tiny_tax_cache';

    /**
     * @param string $key
     * @return string
     */
    public static function taxList($key = 'all')
    {
        return static::$prefix . ".tax.list.{$key}";
    }

    /**
     * @param int|string $key
     * @return string
     */
    public static function taxItem($key)
    {
        return static::$prefix . ".tax.item.{$key}";
    }
}
