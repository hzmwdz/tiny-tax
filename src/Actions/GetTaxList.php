<?php

namespace Hzmwdz\TinyTax\Actions;

use Hzmwdz\TinyTax\Contracts\GetTaxList as GetTaxListContract;
use Hzmwdz\TinyTax\Models\Tax;
use Hzmwdz\TinyTax\Support\CacheKeyHelper;
use Illuminate\Support\Facades\Cache;

class GetTaxList implements GetTaxListContract
{
    /**
     * @var int
     */
    protected $ttl = 7200;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function execute()
    {
        $cacheKey = CacheKeyHelper::taxList();

        return Cache::remember($cacheKey, $this->ttl, function () {
            return Tax::get();
        });
    }
}
