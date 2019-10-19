<?php

namespace Javanile\Forward\Directives\Tests;

use Javanile\Forward\Directives\Report;
use PHPUnit\Framework\TestCase;

class ReportTest extends TestCase
{
    public function testProcess()
    {
        $report = new Report();

        //return 'File is attached';
        $this->assertEquals('Report file not attached', $report->process([], []));
    }
}
