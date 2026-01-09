<?php

namespace Hzmwdz\TinyTax\Contracts;

interface GetTaxList
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function execute();
}
