<?php
/**
 * Short description for class.
 *
 * @author    Francesco Bianco <bianco@javanile.org>
 * @copyright 2019 Javanile
 * @license   https://github.com/javanile/forward/blob/master/LICENSE  MIT License
 *
 * @version   Release: 0.0.1
 *
 * @link      https://github.com/javanile/forward
 */
require_once __DIR__.'/../vendor/autoload.php';

use Javanile\Forward\Directives;
use Javanile\Forward\Forward;

foreach ($_GET as $name => $data) {
    if ($data[0] == '@') {
        $file = substr($data, 1);
        $directives[$name] = [
            'name' => $name,
            'type' => Directives::getTypeByName($name),
            'file' => Directives::getFileSchema($data),
        ];
    } else {
        $directives[$name] = [
            'name' => $name,
            'type' => Directives::getTypeByName($name),
            'data' => $data,
        ];
    }
}

$forward = new Forward(
    ['Name' => '-', 'From' => '-', 'Hash' => 'b3598964c6788457cf7108dcbbb30da67d9121d74501f990b0a4476154768ba6'],
    ['To' => 'test@test.test', 'Token' => '86190a0a069ff69e8bb71265865410fa051b7104d4d14a92661aff95948824e7']
);

echo $forward->parseBody($directives);
