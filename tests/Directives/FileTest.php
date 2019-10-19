<?php

namespace Javanile\Forward\Directives;

use Javanile\Forward\Directives\File;
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
