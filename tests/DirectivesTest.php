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

namespace Javanile\Forward\Tests;

use Javanile\Forward\Directives;
use PHPUnit\Framework\TestCase;

class DirectivesTest extends TestCase
{
    public function testParse()
    {
        $directives = Directives::parse([
            'report' => Directives::getFileSchema(),
        ], [
            'branch' => 'master',
        ]);

        $this->assertEquals([

        ], $directives);
    }
}
