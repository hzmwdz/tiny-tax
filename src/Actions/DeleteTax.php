<?php

namespace Hzmwdz\TinyTax\Actions;

use Hzmwdz\TinyCore\Exceptions\BusinessException;
use Hzmwdz\TinyTax\Contracts\DeleteTax as DeleteTaxContract;
use Hzmwdz\TinyTax\Models\Tax;
use Hzmwdz\TinyTax\Support\CacheKeyHelper;
use Hzmwdz\TinyTax\Support\TransHelper;
use Illuminate\Support\Facades\Cache;

class DeleteTax implements DeleteTaxContract
{
    /**
     * @param int $id
     * @return bool
     * @throws \Hzmwdz\TinyCore\Exceptions\BusinessException
     */
    public function execute($id)
    {
        $tax = $this->findTax($id);

        $tax->delete();

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
     * @param \Hzmwdz\TinyTax\Models\Tax $tax
     * @return void
     */
    protected function clearCache($tax)
    {
        Cache::forget(CacheKeyHelper::taxList());

        Cache::forget(CacheKeyHelper::taxItem($tax->id));
    }
}
