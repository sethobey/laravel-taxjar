<?php

namespace LaraJar;

/**
 * Class Rate
 * @package LaraJar
 *
 * @property string|null $city
 * @property string|null $city_rate
 * @property string|null $combined_district_rate
 * @property string|null $combined_rate
 * @property string $county
 * @property string|null $county_rate
 * @property string|null $distance_sale_threshold
 * @property bool $freight_taxable
 * @property string|null $name
 * @property string|null $parking_rate
 * @property string|null $reduced_rate
 * @property string|null $standard_rate
 * @property string|null $state
 * @property string|null $state_rate
 * @property string|null $super_reduced_rate
 * @property string|null $zip
 */
class Rate extends ApiObject
{
    public const OBJECT_NAME = 'Rate';
}
