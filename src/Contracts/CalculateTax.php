<?php

namespace Hzmwdz\TinyTax\Contracts;

interface CalculateTax
{
    /**
     * @param float $price
     * @return float
     */
    public function execute($price);
}
