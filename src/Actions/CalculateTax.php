<?php

namespace Hzmwdz\TinyTax\Actions;

use Hzmwdz\TinyTax\Contracts\CalculateTax as CalculateTaxContract;
use Hzmwdz\TinyTax\Models\Tax;
use Hzmwdz\TinyTax\Support\CacheKeyHelper;
use Illuminate\Support\Facades\Cache;

class CalculateTax implements CalculateTaxContract
{
    /**
     * @var int
     */
    protected $ttl = 7200;

    /**
     * @param float $price
     * @return float
     */
    public function execute($price)
    {
        $taxes = $this->getAllTaxes();

        return $taxes->sum(function ($tax) use ($price) {
            return $price * ($tax->rate / 100);
        });
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getAllTaxes()
    {
        $cacheKey = CacheKeyHelper::taxList();

        return Cache::remember($cacheKey, $this->ttl, function () {
            return Tax::get();
        });
    }
}
