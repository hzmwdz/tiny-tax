<?php

namespace Hzmwdz\TinyTax\Contracts;

interface CreateTax
{
    /**
     * @param array $data
     * @return \Hzmwdz\TinyTax\Models\Tax
     */
    public function execute($data);
}
