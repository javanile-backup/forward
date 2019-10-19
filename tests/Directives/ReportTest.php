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

use Javanile\Forward\Directives\Report;
use PHPUnit\Framework\TestCase;

class ReportTest extends TestCase
{
    public function testProcess()
    {
        if (empty($directive['file'])) {
            return 'Report file not attached';
        }

        return 'Report is attached';
    }
}
