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

if (empty($argv[1])) {
    die("Missing email address.\n");
}

if (!filter_var($argv[1], FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format.\n");
}

if (empty($argv[2])) {
    die("Missing secret passphrase.\n");
}

echo hash("sha256", strtolower($argv[1]).":".hash("sha256", 'forward:'.$argv[2])) . "\n";
