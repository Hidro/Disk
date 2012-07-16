<?php
namespace Hidro\Disk\Adapters;

class NullOverride
{
    function stream_open($path, $mode, $options, &$opened_path)
    {
        return true;
    }
    
    function stream_stat()
    {
        return array();
    }
    
    function url_stat()
    {
        return array();
    }

    function stream_read($count)
    {
    }

    function stream_write($data)
    {
    }

    function stream_tell()
    {
    }

    function stream_eof()
    {
    }

    function stream_seek($offset, $whence)
    {
    }

    function stream_metadata($path, $option, $var) 
    {
    }
}
