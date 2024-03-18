<?php

declare(strict_types=1);

namespace Framework;

/**
 * The App class serves as the core of the application, responsible for bootstrapping,
 * configuration management, dependency injection, and providing access to global resources.
 */

class App
{

  private Router $router;
  private Container $container;

  /**
   * class constructor.
   *
   * @param string|null $containerDefinitionsPath
   */

  public function __construct(string $containerDefinitionsPath = null)
  {
    $this->router = new Router();
    $this->container = new Container();
    if ($containerDefinitionsPath) {
      $containerDefinitions = include $containerDefinitionsPath;
      $this->container->addDefinitions($containerDefinitions);
    }
  }
  /**
   * this function is for running the app 
   *
   * @return void
   */
  public function run()
  {
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $method = $_SERVER['REQUEST_METHOD'];

    $this->router->dispatch($path, $method, $this->container);
  }
  /**
   * this function is for adding a route to the router
   *
   * @param string $path
   * @param array $controller
   * @return void
   */
  public function get(string $path, array $controller)
  {
    $this->router->add('GET', $path, $controller);
  }

  public function post(string $path, array $controller)
  {
    $this->router->add('POST', $path, $controller);
  }


  /**
   * addMiddleware() is a method that adds a middleware to the router.  
   */

  public function addMiddleware(string $middleware)
  {
    $this->router->addMiddleware($middleware);
  }
}
