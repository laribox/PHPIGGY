<?php

declare(strict_types=1);

namespace Framework;

/**
 * this class is responsible for routing requests to the correct controller
 */
class Router
{
  private array $routes = [];
  private array $middlewares = [];

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
    $regexPath = preg_replace('#{[^/]+}#', '([^/]+)', $path);

    $this->routes[] = [
      'path' => $path,
      'method' => strtoupper($method),
      'controller' => $controller,
      'middlewares' => [],
      'regexPath' =>  $regexPath
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
    $method = strtoupper($_POST['_METHOD'] ?? $method);

    foreach ($this->routes as $route) {


      if (!preg_match("#^{$route['regexPath']}$#", $path, $paramValues) || $route['method'] !== $method) {
        continue;
      }
      array_shift($paramValues);
      preg_match_all('#{([^/]+)}#', $route['path'], $paramKeys);

      $paramKeys = $paramKeys[1];

      $params = array_combine($paramKeys, $paramValues);



      [$class, $function] = $route['controller'];

      $controllerInstance = $container ? $container->resolve($class) : new $class;

      $action = fn () => $controllerInstance->$function($params);

      $allMiddlewares = [...$route['middlewares'], ...$this->middlewares];

      foreach ($allMiddlewares as $middleware) {
        $middlewareInstance = $container ? $container->resolve($middleware) :  new $middleware;
        $action = fn () => $middlewareInstance->process($action);
      }

      $action();

      return;
    }
  }
  /**
   * Adding a middleware to the router.
   *
   * This function adds a middleware to the router, which will be executed before the controller.
   * The middleware will be executed in the order it is added.
   *
   * @param string $middleware
   * @return void
   */
  public function addMiddleware(string $middleware)
  {
    $this->middlewares[] = $middleware;
  }

  /**
   * Add middleware to the last route in the routes array.
   *
   * @param string $middleware The middleware to add
   */
  public function addRouteMiddleware(string $middleware)
  {
    $lastRouteKey = array_key_last($this->routes);
    $this->routes[$lastRouteKey]['middlewares'][] = $middleware;
  }
}
