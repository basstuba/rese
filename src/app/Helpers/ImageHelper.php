<?php

namespace App\Helpers;

class ImageHelper {
    public static function imageUrl($url) {
        if (preg_match("/^https?:\/\//", $url)) {
            return $url;
        }
        return asset($url);
    }
}
