<?php

namespace LaraJar\Contracts;

interface Order
{
    public function getTaxJarOrderTransactionId();

    public function getTaxJarOrderDetails();
}
