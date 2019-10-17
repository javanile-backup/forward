<?php
/**
 * Short description for class
 *
 * @package    Javanile\Forward
 * @author     Francesco Bianco <bianco@javanile.org>
 * @copyright  2019 Javanile
 * @license    https://github.com/javanile/forward/blob/master/LICENSE  MIT License
 * @version    Release: 0.0.1
 * @link       https://github.com/javanile/forward
 */

require_once __DIR__.'/vendor/autoload.php';

use Javanile\Forward\Forward;
use Javanile\Forward\Directive;

foreach ($_GET as $name => $data) {
    if ($data[0] == '@') {
        $file = substr($data, 1);
        $directives[$name] = [
            'name' => $name,
            'type' => Directive::getTypeByName($name),
            'file' => [
                'name' => basename($data),
                'type' => 'text/plain',
                'tmp_name'=> $file,
                'error' => 0,
                'size' => filesize($file),
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

$forward = new Forward(['Hash' => ''], []);

echo $forward->getBody($directives);
