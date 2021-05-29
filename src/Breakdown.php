<?php

namespace LaraJar;

/**
 * Class Category
 * @package LaraJar
 *
 * @property float $taxable_amount
 * @property float $tax_collectable
 * @property float|null $combined_tax_rate
 * @property float|null $state_taxable_amount
 * @property float|null $state_sales_tax_rate
 * @property float|null $state_amount
 * @property float|null $county_taxable_amount
 * @property float|null $county_sales_tax_rate
 * @property float|null $county_amount
 * @property float|null $city_taxable_amount
 * @property float|null $city_sales_tax_rate
 * @property float|null $city_amount
 * @property float|null $special_district_taxable_amount
 * @property float|null $special_district_sales_tax_rate
 * @property float|null $special_district_amount
 * @property float|null $gst_taxable_amount
 * @property float|null $gst_sales_tax_rate
 * @property float|null $gst_amount
 * @property float|null $pst_taxable_amount
 * @property float|null $pst_sales_tax_rate
 * @property float|null $pst_amount
 * @property float|null $qst_taxable_amount
 * @property float|null $qst_sales_tax_rate
 * @property float|null $qst_amount
 * @property float|null $country_taxable_amount
 * @property float|null $country_tax_rate
 * @property float|null $country_tax_collectable
 * @property object $shipping
 * @property \Illuminate\Support\Collection|LineItem[] $line_items
 */
class Breakdown extends ApiObject
{
    public const OBJECT_NAME = 'Breakdown';
}
