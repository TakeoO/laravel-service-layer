<?php

namespace Takeoo\Service\Storage\InstaceStorage;


/**
 * Stores every instances created via Takeoo\Service\Trait\Services
 * Class InstanceStorage
 * @package Takeoo\Service\Storage\InstaceStorage
 */
class InstanceStorage
{
  
  /**
   * Static array of service instances
   * @var array
   */
  public static $_instances = [];
  
  
  /**
   * Check if service name is in storage
   * @param string $serviceName
   * @return bool
   */
  public static function has(string $serviceName): bool
  {
    return in_array($serviceName, array_keys(self::$_instances));
  }
  
  
  /**
   * Gets service instance if exists
   * @param string $serviceName
   * @return mixed|null
   */
  public static function get(string $serviceName)
  {
    return self::$_instances[$serviceName] ?? null;
  }
  
  /**
   * @param string $serviceName
   * @param $instance
   */
  public static function set(string $serviceName, $instance)
  {
    self::$_instances[$serviceName] = $instance;
  }
  
}