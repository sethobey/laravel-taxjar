<?php

namespace LaraJar;

/**
 * Class Tax
 * @package LaraJar
 *
 * @property float $order_total_amount
 * @property float $shipping
 * @property float $taxable_amount
 * @property float $amount_to_collect
 * @property float $rate
 * @property bool $has_nexus
 * @property bool $freight_taxable
 * @property string $tax_source
 * @property object $jurisdictions
 * @property Breakdown $breakdown
 */
class Tax extends ApiObject
{
    public const OBJECT_NAME = 'Tax';
}
