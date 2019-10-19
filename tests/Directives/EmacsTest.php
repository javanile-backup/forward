<?php

namespace Javanile\Forward\Directives\Tests;

use Javanile\Forward\Directives\Emacs;
use PHPUnit\Framework\TestCase;

class EmacsTest extends TestCase
{
    public function testProcess()
    {
        $emacs = new Emacs();

        //return 'File is attached';
        $this->assertEquals('Emacs file not attached', $emacs->process([], []));
    }
}
