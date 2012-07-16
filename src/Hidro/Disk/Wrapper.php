<?php
namespace Hidro\Disk;

class Wrapper
{
    public static $overridenProtocol = 'file';
    public static $isRegistered = false;
    public static $adapterClass = 'Hidro\Disk\Adapters\NullOverride';
    public static $adapterInstance = null;
    
    public function __construct()
    {
        static::addAdapter(static::$adapterClass);
    }
    
    public static function __callStatic($adapter, $args)
    {
        $adapter = ucfirst($adapter);
        static::$adapterClass = "Hidro\\Disk\\Adapters\\$adapter";
        static::addAdapter(static::$adapterClass, $args);
        static::ensureOverride();
    }
    
    public static function addAdapter($class, $args=array())
    {
        static::$adapterInstance = new $class;
    }
    
    public function ensureOverride()
    {
        if (static::$isRegistered) {
            return;
        }
        
        stream_wrapper_unregister(static::$overridenProtocol);
        stream_wrapper_register(static::$overridenProtocol, __CLASS__);
        static::$isRegistered = true;
    }

    function stream_open($path, $mode, $options, &$opened_path)
    {
        return static::$adapterInstance->stream_open($path, $mode, $options, $opened_path);
    }
    
    function stream_stat()
    {
        return static::$adapterInstance->stream_stat();
    }
    
    function url_stat()
    {
        return static::$adapterInstance->url_stat();
    }

    function stream_read($count)
    {
        return static::$adapterInstance->stream_read($count);
    }

    function stream_write($data)
    {
        return static::$adapterInstance->stream_write($data);
    }

    function stream_tell()
    {
        return static::$adapterInstance->stream_tell();
    }

    function stream_eof()
    {
        return static::$adapterInstance->stream_eof();
    }

    function stream_seek($offset, $whence)
    {
        return static::$adapterInstance->stream_seek();
    }

    function stream_metadata($path, $option, $var) 
    {
        return static::$adapterInstance->stream_metadata();
    }
}

