<?php

namespace Javanile\Forward;

class Forward
{
    public static function getBody($directives)
    {
        ob_start();

        include __DIR__.'/../template/index.php';

        $html = ob_get_clean();

        return $html;
    }
}


