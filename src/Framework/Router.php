<?php

declare(strict_types=1);

namespace Framework;

/**
 * this class is responsible for routing requests to the correct controller
 */
class Router
{
  private array $routes = [];

  /**
   * this function adds a route to the router
   *
   * @param string $method
   * @param string $path
   * @param [type] $controller
   * @return void
   */
  public function add(string $method, string $path, $controller)
  {
    $path = $this->normalizePath($path);
    $this->routes[] = [
      'path' => $path,
      'method' => strtoupper($method),
      'controller' => $controller
    ];
  }
  /**
   * this function normalizes the path by removing any leading or trailing slashes and replacing any duplicate slashes with a single slash.
   *
   * @param string $path
   * @return string
   */
  private function normalizePath(string $path): string
  {
    $path = trim($path, '/');
    $path = "/{$path}/";
    $path = preg_replace('#[/]{2,}#', '/', $path);

    return $path;
  }

  /**
   * this function dispatches the request to the correct controller based on the path and method.
   *
   * @param string $path
   * @param string $method
   * @param Container|null $container
   * @return void
   */
  public function dispatch(string $path, string $method, Container $container = null)
  {
    $path = $this->normalizePath($path);
    $method = strtoupper($method);

    foreach ($this->routes as $route) {


      if (!preg_match("#^{$route['path']}$#", $path) || $route['method'] !== $method) {
        continue;
      }

      [$class, $function] = $route['controller'];

      $controllerInstance = $container ? $container->resolve($class) : new $class;

      $controllerInstance->$function();
    }
  }
}
