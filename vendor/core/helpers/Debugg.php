<?php

namespace core\helpers;


class Debugg
{
    public static function debugVar($var)
    {
        echo "<code><pre>".print_r($var, 1)."</pre></code>";
    }
}