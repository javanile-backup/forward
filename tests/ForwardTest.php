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

use Javanile\Forward\Forward;
use PHPUnit\Framework\TestCase;

class ForwardTest extends TestCase
{
    public function testProcess()
    {
        $forward = new Forward([], []);
        $this->assertEquals(false, $forward->process());
    }
}
