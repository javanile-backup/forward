<?php
/**
 * Short description for class
 *
 * @package   Javanile\Forward
 * @author    Francesco Bianco <bianco@javanile.org>
 * @copyright 2019 Javanile
 * @license   https://github.com/javanile/forward/blob/master/LICENSE  MIT License
 * @version   Release: 0.0.1
 * @link      https://github.com/javanile/forward
 */

namespace Javanile\Forward\Directives;

class FileTest
{
    /**
     * @param $directive
     * @param $directives
     * @return string
     */
    public function process($directive, $directives)
    {
        if (empty($directive['file'])) {
            return 'File not attached';
        }

        return 'File is attached';
    }
}
