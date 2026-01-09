<?php

namespace Hzmwdz\TinyTax\Actions;

use Hzmwdz\TinyTax\Contracts\GetTax as GetTaxContract;
use Hzmwdz\TinyTax\Models\Tax;
use Hzmwdz\TinyTax\Support\CacheKeyHelper;
use Illuminate\Support\Facades\Cache;

class GetTax implements GetTaxContract
{
    /**
     * @var int
     */
    protected $ttl = 7200;

    /**
     * @param int $id
     * @return \Hzmwdz\TinyTax\Models\Tax|null
     */
    public function execute($id)
    {
        $cacheKey = CacheKeyHelper::taxItem($id);

        return Cache::remember($cacheKey, $this->ttl, function () use ($id) {
            return Tax::find($id);
        });
    }
}
