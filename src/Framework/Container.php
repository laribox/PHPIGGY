<?php

declare(strict_types=1);

namespace Framework;

use ReflectionClass, ReflectionNamedType;
use Framework\Exceptions\ContainerException;


/**
 * this class is used to manage class dependencies.
 * it has a private array called $definitions that stores the class definitions. 
 */

class Container
{
  private array $definitions = [];
  private array $resolved = [];

  public function addDefinitions(array $newDefinitions)
  {
    $this->definitions = [...$this->definitions, ...$newDefinitions];
  }
  /**
   * this function is used to resolve class dependencies.
   * it checks if the class has a constructor and if it does, it checks if the constructor has parameters.
   * if it does, it checks if the parameters are of type ReflectionNamedType and if they are not of type ReflectionNamedType, it throws an exception.
   * if the constructor has no parameters, it creates a new instance of the class.
   * if the constructor has parameters, it creates a new instance of the class and passes the dependencies as arguments to the constructor.
   * it returns the new instance of the class.
   *
   * @param string $className
   * @return void
   */

  public function resolve(string $className)
  {
    $reflectionClass = new ReflectionClass($className);

    if (!$reflectionClass->isInstantiable()) {
      throw new ContainerException("Class {$className} is not instantiable");
    }

    $constructor = $reflectionClass->getConstructor();

    if (!$constructor) {
      return new $className;
    }

    $params = $constructor->getParameters();

    if (count($params) === 0) {
      return new $className;
    }

    $dependencies = [];

    foreach ($params as $param) {
      $name = $param->getName();
      $type = $param->getType();

      if (!$type) {
        throw new ContainerException("Failed to resolve class {$className} because param {$name} is missing a type hint.");
      }

      if (!$type instanceof ReflectionNamedType || $type->isBuiltin()) {
        throw new ContainerException("Failed to resolve class {$className} because invalid param name.");
      }

      $dependencies[] = $this->get($type->getName());
    }

    return $reflectionClass->newInstanceArgs($dependencies);
  }
  /**
   * this function is used to get a class from the container.
   *
   * @param string $id
   * @return void
   */

  public function get(string $id)
  {
    if (!array_key_exists($id, $this->definitions)) {
      throw new ContainerException("Class {$id} does not exist in container.");
    }

    if (array_key_exists($id, $this->resolved)) {
      return $this->resolved[$id];
    }

    $factory = $this->definitions[$id];
    $dependency = $factory($this);

    $this->resolved[$id] = $dependency;

    return $dependency;
  }
}
