<?php
namespace Hidro\Disk;

class Wrapper
{
    public static $overridenProtocol = 'data';
    public static $isRegistered = false;
    public static $adapterClass = 'Hidro\Disk\Adapters\NullOverride';
    
    public static function __callStatic($adapter, $args)
    {
        $adapter = ucfirst($adapter);
        static::$adapterClass = "Hidro\\Disk\\Adapters\\$adapter";
        static::ensureOverride();
    }
    
    public function ensureOverride()
    {
        if (static::$isRegistered) {
            return;
        }
        
        stream_wrapper_unregister(static::$overridenProtocol);
        stream_wrapper_register(static::$overridenProtocol, static::$adapterClass);
        static::$isRegistered = true;
    }

}

