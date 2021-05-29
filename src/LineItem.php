<?php

namespace LaraJar;

/**
 * Class Category
 * @package LaraJar
 *
 * @property string $id
 * @property float $taxable_amount
 * @property float $tax_collectable
 * @property float $state_taxable_amount
 * @property float $state_sales_tax_rate
 * @property float $state_amount
 * @property float $county_taxable_amount
 * @property float $county_sales_tax_rate
 * @property float $county_amount
 * @property float $city_taxable_amount
 * @property float $city_sales_tax_rate
 * @property float $city_amount
 * @property float $special_district_taxable_amount
 * @property float $special_district_sales_tax_rate
 * @property float $special_district_amount
 */
class LineItem extends ApiObject
{
    public const OBJECT_NAME = 'LineItem';
}
