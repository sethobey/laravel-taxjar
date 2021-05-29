<?php

namespace LaraJar\Util;

use Illuminate\Support\Str;
use LaraJar\Rate;
use LaraJar\Tax;

class Util
{
    public static function convertToLaraJarObject($response, $type = null)
    {
        $types = ObjectTypes::mapping;

        if (is_array($response)) {
            return collect($response)->map(function ($object) use ($type) {
                return self::convertToLaraJarObject($object, $type);
            });
        }

        if ($type && is_object($response)) {
            $className = Str::singular(Str::studly($type));
            if (array_key_exists($className, $types)) {
                foreach ((array) $response as $key => $val) {
                    $response->$key = self::convertToLaraJarObject($val, $key);
                }

                return new $types[$className]((array) $response);
            }
        }

        return $response;
    }
}
