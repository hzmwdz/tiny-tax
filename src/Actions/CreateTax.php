<?php

namespace Hzmwdz\TinyTax\Actions;

use Hzmwdz\TinyCore\Exceptions\BusinessException;
use Hzmwdz\TinyTax\Contracts\CreateTax as CreateTaxContract;
use Hzmwdz\TinyTax\Models\Tax;
use Hzmwdz\TinyTax\Support\CacheKeyHelper;
use Hzmwdz\TinyTax\Support\TransHelper;
use Hzmwdz\TinyTax\Validators\CreateTaxValidator;
use Illuminate\Support\Facades\Cache;

class CreateTax implements CreateTaxContract
{
    /**
     * @param array $data
     * @return \Hzmwdz\TinyTax\Models\Tax
     */
    public function execute($data)
    {
        $validated = CreateTaxValidator::validate($data);

        $this->ensureTaxNotExists($validated['name']);

        $tax = Tax::create($validated);

        $this->clearCache();

        return $tax;
    }

    /**
     * @param string $name
     * @return void
     * @throws \Hzmwdz\TinyCore\Exceptions\BusinessException
     */
    protected function ensureTaxNotExists($name)
    {
        if (Tax::where('name', $name)->exists()) {
            throw new BusinessException(
                TransHelper::taxAlreadyExists($name)
            );
        }
    }

    /**
     * @return void
     */
    protected function clearCache()
    {
        Cache::forget(CacheKeyHelper::taxList());
    }
}
