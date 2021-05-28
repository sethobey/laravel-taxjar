<?php

namespace LaraJar;

/**
 * Class Category
 * @package LaraJar
 *
 * @property string $name
 * @property string $product_tax_code
 * @property string $description
 */
class Category
{
    public function __construct($attributes = [])
    {
        foreach ($attributes as $key => $value) {
            $this->$key = $value;
        }
    }
}
