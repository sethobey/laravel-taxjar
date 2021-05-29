<?php

namespace LaraJar\Util;

class ObjectTypes
{
    public const mapping = [
        \LaraJar\Breakdown::OBJECT_NAME => \LaraJar\Breakdown::class,
        \LaraJar\Category::OBJECT_NAME => \LaraJar\Category::class,
        \LaraJar\LineItem::OBJECT_NAME => \LaraJar\LineItem::class,
        \LaraJar\Rate::OBJECT_NAME => \LaraJar\Rate::class,
        \LaraJar\Region::OBJECT_NAME => \LaraJar\Region::class,
        \LaraJar\Tax::OBJECT_NAME => \LaraJar\Tax::class,
    ];
}
