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

require_once __DIR__.'/../vendor/autoload.php';

use Javanile\Forward\Forward;

$config = require_once __DIR__.'/../config.php';

$headers = getallheaders();

$forward = new Forward($config, $headers);

try {
    echo $forward->send();
} catch (Exception $error) {
    echo $error->getMessage();
}
