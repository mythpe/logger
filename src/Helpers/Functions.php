<?php
/**
 * Copyright MyTh
 * Website: https://4MyTh.com
 * Email: mythpe@gmail.com
 * Copyright © 2006-2020 MyTh All rights reserved.
 */

use Myth\Support\Logger;

if(!function_exists('myth_logger')){

    /**
     * @param $content
     * @param null $name
     * @param null $path
     * @return mixed|string
     */
    function myth_logger($content, $name = null, $path = null)
    {
        return Logger::log($content, $name, $path);
    }
}