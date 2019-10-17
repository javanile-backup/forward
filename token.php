<?php
/**
 *
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

echo hash("sha256", strtolower($argv[1]).":".$argv[2]) . "\n";
