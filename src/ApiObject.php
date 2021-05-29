<?php


namespace LaraJar;


abstract class ApiObject
{
    public function __construct($attributes = [])
    {
        foreach ($attributes as $key => $value) {
            $this->$key = $value;
        }
    }
}
