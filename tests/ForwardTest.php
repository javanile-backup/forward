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

        $forward = new Forward([], []);
        $this->assertEquals(false, $forward->process());
    }

    public function testResponse()
    {
        $forward = new Forward([], []);

        $this->assertEquals('{"info":"Message successful sent."}'."\n", $forward->successResponse());
        $this->assertEquals('{"problem":"Problem to send message."}'."\n", $forward->problemResponse());
        $this->assertEquals('{"exception":"Fake exception."}'."\n", $forward->exceptionResponse(new \Exception("Fake exception.")));
    }
}
