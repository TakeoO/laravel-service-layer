<?php

namespace Takeoo\Service\Traits;

use Illuminate\Support\Facades\App;
use Takeoo\Service\Exception\InvalidServiceException;

/**
 * Class Service
 * @package Takeoo\Service\Traits
 */
trait Service
{
  /**
   * @param string $serviceName
   */
  public function getService(string $serviceName)
  {
    return App::make($this->getServicePath($serviceName));
  }
  
  /**
   * @param $serviceName
   * @return string
   * @throws \Exception
   */
  public function getServicePath($serviceName): string
  {
    $services = config("service.services");
    
    if (!in_array($serviceName, array_keys($services)))
      throw new InvalidServiceException(sprintf("Service not implemented [%s]", $serviceName));
    
    $className = $services[$serviceName];
    
    if (!class_exists($className))
      throw new InvalidServiceException(sprintf("Service not implemented [%s]", $serviceName));
    
    return $className;
  }
}
