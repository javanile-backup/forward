<?php
/**
 * Short description for class.
 *
 * @author    Francesco Bianco <bianco@javanile.org>
 * @copyright 2019 Javanile
 * @license   https://github.com/javanile/forward/blob/master/LICENSE  MIT License
 *
 * @version   Release: 0.0.1
 *
 * @link      https://github.com/javanile/forward
 */

namespace Javanile\Forward\Tests;

use Javanile\Forward\Directives;
use PHPUnit\Framework\TestCase;

class DirectivesTest extends TestCase
{
    public function testParseSingleFile()
    {
        $file = __DIR__.'/fixtures/report.txt';
        $directives = Directives::parse([
            'report' => Directives::getFileSchema($file),
        ], [
            'branch' => 'master',
        ]);

        $this->assertEquals([
            'report' => [
                'name' => 'report',
                'type' => 'report',
                'file' => Directives::getFileSchema($file),
            ],
            'branch' => [
                'name' => 'branch',
                'type' => 'branch',
                'data' => 'master',
            ],
        ], $directives);
    }

    public function testParseMultipleFile()
    {
        $file0 = __DIR__.'/fixtures/emacs.txt';
        $file1 = __DIR__.'/fixtures/report.txt';
        $directives = Directives::parse([
            'emacs'  => Directives::getFileSchema($file0),
            'report' => Directives::getFilesSchema([$file0, $file1]),
        ], [
            'branch' => 'master',
        ]);

        $this->assertEquals([
            'emacs' => [
                'name' => 'emacs',
                'type' => 'emacs',
                'file' => Directives::getFileSchema($file0),
            ],
            'report[0]' => [
                'name' => 'report[0]',
                'type' => 'report',
                'file' => Directives::getFileSchema($file0),
            ],
            'report[1]' => [
                'name' => 'report[1]',
                'type' => 'report',
                'file' => Directives::getFileSchema($file1),
            ],
            'branch' => [
                'name' => 'branch',
                'type' => 'branch',
                'data' => 'master',
            ],
        ], $directives);
    }
}
