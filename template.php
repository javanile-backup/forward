<?php
/**
 *
 */

require_once __DIR__.'/vendor/autoload.php';

use Javanile\Forward\Forward;
use Javanile\Forward\Directive;

foreach ($_GET as $name => $data) {
    if ($value[0] == '@') {
        $directives[$name] = [
            'name' => $name,
            'type' => Directive::getTypeByName($name),
            'file' => [
                'name' => basename($data),
                'type' => 'text/plain',
                'tmp_name'=> substr($data, 1),
                'error' => 0,
                'size' => 17,
            ],
        ];
    } else {
        $directives[$name] = [
            'name' => $name,
            'type' => Directive::getTypeByName($name),
            'data' => $data,
        ];
    }
}


echo Forward::getBody($directives);


/*
array(1) {
    ['report']=>

  }
}



*/