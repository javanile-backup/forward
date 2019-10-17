<?php

namespace Javanile\Forward;

class Forward
{



    public static function getBody()
    {
        ob_start();

        include __DIR__.'/../templates/index.php';

        $html = ob_get_flush();

        return $html;
    }




}


