<?php

namespace Takeoo\Service;


use Illuminate\Support\ServiceProvider;

/**
 * Class TakeooServiceServiceProvider
 * @package Takeoo\Service
 */
class TakeooServiceServiceProvider extends ServiceProvider
{
  /**
   * @return void
   */
  public function boot()
  {
    $this->publishes([
      __DIR__ . '/../config/service.php' => config_path('service.php'),
    ]);
  }
  
  public function register()
  {
    //
  }
}