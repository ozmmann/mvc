<?php

namespace core\components;


class Url
{
    /**
     * @param integer $n
     * @return string|null
     */
    static public function getRouteSegment($n)
    {
        $segments = self::getRouteSegments();
        if (!empty($segments[$n])) {
            return $segments[$n];
        }
        return null;
    }

    /**
     * @return array
     */
    static public function getRouteSegments()
    {
        $url = $_GET['r'];
        $segments = explode('/', $url);
        if (empty($segments[0])) {
            return [];
        }
        $lastIndex = count($segments) - 1;
        if (empty($segments[$lastIndex])) {
            array_pop($segments);
        }

        return $segments;
    }

    /**
     * @param string $param
     * @return string|null
     */
    static public function getParam($param)
    {
        return isset($_GET[$param]) ? $_GET[$param] : null;
    }
}