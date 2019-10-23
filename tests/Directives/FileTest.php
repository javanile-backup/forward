<?php

namespace Javanile\Forward\Directives;

use PHPUnit\Framework\TestCase;

class FileTest extends TestCase
{
    public function testProcess()
    {
        $file = new File();

        //return 'File is attached';
        $this->assertEquals('File not attached', $file->process([], []));
    }
}
