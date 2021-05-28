<?php

namespace LaraJar\Contracts;

interface Refund
{
    public function getTaxJarRefundTransactionId();

    public function getTaxJarRefundDetails();
}
