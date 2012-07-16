<?php
namespace Hidro\Disk;

use PHPUnit_Framework_TestCase;

class WrapperTest extends PHPUnit_Framework_TestCase
{
    protected $wrappers = array();
    
    public function setUp()
    {
        if (!$this->wrappers) {
            $this->wrappers = stream_get_wrappers();
        }
    }
    
    public function tearDown()
    {
        foreach ($this->wrappers as $w) {
            stream_wrapper_restore($w);
        }
    }
    
    public function testCanOverrideNativeFileWrapper()
    {
        //Autoloader will not work anymore after Wrapper::nullOverride()
        class_exists('PHPUnit_Framework_TestFailure');
        class_exists('PHPUnit_Framework_Constraint_IsIdentical');
        class_exists('PHPUnit_Util_Filter');
        class_exists('Hidro\Disk\Adapters\NullOverride');
        class_exists('Hidro\Disk\Adapters\NullOverride');
        
        Wrapper::nullOverride();
        
        $output = file_get_contents('/hahhhaahaha/foobar.lol');
        
        $this->assertSame('', $output);
    }
}

