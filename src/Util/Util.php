<?php

namespace LaraJar\Util;

use LaraJar\Category;

class Util
{
    public static function convertToLaraJarObject($response, $type = null)
    {
        if (is_array($response)) {
            return collect($response)
                ->map(function ($resObj) use ($type) {
                    if ($type) {
                        return new $type((array) $resObj);
                    } else {
                        return $resObj;
                    }
                });
        }

        return $response;
    }
}
