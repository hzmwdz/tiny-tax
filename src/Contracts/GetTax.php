<?php

namespace Hzmwdz\TinyTax\Contracts;

interface GetTax
{
    /**
     * @param int $id
     * @return \Hzmwdz\TinyTax\Models\Tax|null
     */
    public function execute($id);
}
