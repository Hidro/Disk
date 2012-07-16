<?php
namespace Hidro\Disk;

use PHPUnit_Framework_TestCase;

class WrapperTest extends PHPUnit_Framework_TestCase
{
    public function testCanOverrideNativeFileWrapper()
    {
        Wrapper::nullOverride();
        
        $output = file_get_contents('data:///hahhhaahaha/foobar.lol');
        
        $this->assertSame('', $output);
    }
}

