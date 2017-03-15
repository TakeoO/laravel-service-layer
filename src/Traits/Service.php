<?php

namespace Takeoo\Service\Traits;

use Illuminate\Support\Facades\App;
use Takeoo\Service\Exception\InvalidServiceException;
use Takeoo\Service\Storage\InstanceStorage;

/**
 * Class Service
 * @package Takeoo\Service\Traits
 */
trait Service
{
  
  /**
   * Gets service
   *  - if instance exits in temporary storage, return it
   *  - create service
   *  - if service is not singleton, cache it to temporary array
   *  - return service class
   * @param string $serviceName
   * @return mixed|null
   */
  public function getService(string $serviceName)
  {
    if (InstanceStorage::has($serviceName))
      return InstanceStorage::get($serviceName);
    
    $service = $this->getServicePath($serviceName);
    
    $this->checkService($service);
    
    return $this->createService($serviceName, $service);
  }
  
  /**
   * Gets service from services array
   * @param $serviceName
   * @return string
   * @throws \Exception
   */
  public function getServicePath(string $serviceName): string
  {
    $services = config("service.services") ??  [];
    
    if (!in_array($serviceName, array_keys($services)))
      throw new InvalidServiceException(sprintf("Service not implemented [%s]", $serviceName));
    
    return $services[$serviceName];
  }
  
  
  /**
   * Checks if service class exists
   * @param string $service
   * @throws InvalidServiceException
   */
  private function checkService(string $service)
  {
    if (!class_exists($service))
      throw new InvalidServiceException(sprintf("Service class not found [%s]", $service));
  }
  
  
  /**
   * Creates new service
   *  - if service is set as singleton it wont be stored to temporary array
   * @param string $serviceName
   * @param string $service
   * @return string
   */
  private function createService(string $serviceName, string $service)
  {
    $singletons = config('service.singletons') ?? [];
    
    $serviceClass = App::make($service);
    
    if (!in_array($serviceName, $singletons))
      InstanceStorage::set($serviceName, $serviceClass);
    
    return $service;
  }
}
