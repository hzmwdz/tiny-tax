<?php

namespace Hzmwdz\TinyTax\Actions;

use Hzmwdz\TinyCore\Exceptions\BusinessException;
use Hzmwdz\TinyTax\Contracts\UpdateTax as UpdateTaxContract;
use Hzmwdz\TinyTax\Models\Tax;
use Hzmwdz\TinyTax\Support\CacheKeyHelper;
use Hzmwdz\TinyTax\Support\TransHelper;
use Hzmwdz\TinyTax\Validators\UpdateTaxValidator;
use Illuminate\Support\Facades\Cache;

class UpdateTax implements UpdateTaxContract
{
    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function execute($id, $data)
    {
        $validated = UpdateTaxValidator::validate($data);

        $tax = $this->findTax($id);

        $this->ensureTaxNotExists($tax->id, $validated['name']);

        $tax->update($validated);

        $this->clearCache($tax);

        return true;
    }

    /**
     * @param int $id
     * @return \Hzmwdz\TinyTax\Models\Tax
     * @throws \Hzmwdz\TinyCore\Exceptions\BusinessException
     */
    protected function findTax($id)
    {
        $tax = Tax::find($id);

        if (!$tax) {
            throw new BusinessException(
                TransHelper::taxNotFound($id)
            );
        }

        return $tax;
    }

    /**
     * @param int $id
     * @param string $name
     * @return void
     * @throws \Hzmwdz\TinyCore\Exceptions\BusinessException
     */
    protected function ensureTaxNotExists($id, $name)
    {
        if (Tax::where('name', $name)->where('id', '!=', $id)->exists()) {
            throw new BusinessException(
                TransHelper::taxAlreadyExists($name)
            );
        }
    }

    /**
     * @param \Hzmwdz\TinyTax\Models\Tax $tax
     * @return void
     */
    protected function clearCache($tax)
    {
        Cache::forget(CacheKeyHelper::taxList());

        Cache::forget(CacheKeyHelper::taxItem($tax->id));
    }
}
