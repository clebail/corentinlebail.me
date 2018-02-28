<?php
class Core_Cache {
    public static function get($key) {
        if(Core_Config::getConfigValue("cache/enable")) {
            if(($memcache_obj = memcache_connect(Core_Config::getConfigValue("cache/host"), Core_Config::getConfigValue("cache/port"))) !== false) {
                $result = memcache_get($memcache_obj, $key);
                
                return $result;
            }
        }
        
        return false;
    }
    
    public static function set($key, $value) {
        if(Core_Config::getConfigValue("cache/enable")) {
            if(($memcache_obj = memcache_connect(Core_Config::getConfigValue("cache/host"), Core_Config::getConfigValue("cache/port"))) !== false) {
                return memcache_set($memcache_obj, $key, $value, 0, Core_Config::getConfigValue("cache/expire"));
            }
        }
        
        return true;
    }
    
    public static function delete($key) {
        if(Core_Config::getConfigValue("cache/enable")) {
            if(($memcache_obj = memcache_connect(Core_Config::getConfigValue("cache/host"), Core_Config::getConfigValue("cache/port"))) !== false) {
                return memcache_delete($memcache_obj, $key);
            }
        }
    }
}