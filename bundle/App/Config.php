<?php namespace App;

class Config
{
    private static $data = array();
    
    public static function get($key)
    {
        if (self::exists($key))
            return self::$data[$key];
        
        return null;
    }
    
    public static function set($key, $value = null)
    {
        if (is_array($key)) {
            foreach ($key as $entry => $entryValue) {
                self::$data[$entry] = $entryValue;
            }
        } else {
            return self::$data[$key] = $value;
        }
    }
    
    public static function exists($key)
    {
        if (isset(self::$data[$key]))
            return true;
        
        return false;
    }
}