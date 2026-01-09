<?php

namespace Hzmwdz\TinyTax\Contracts;

interface DeleteTax
{
    /**
     * @param int $id
     * @return bool
     */
    public function execute($id);
}
