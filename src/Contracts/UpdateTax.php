<?php

namespace Hzmwdz\TinyTax\Contracts;

interface UpdateTax
{
    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function execute($id, $data);
}
