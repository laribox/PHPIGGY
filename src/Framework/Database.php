<?php

declare(strict_types=1);

namespace Framework;

use PDO, PDOException;

class Database
{

  public PDO $connection;

  public function __construct(string $driver, array $config, string $username, string $password)
  {
    $config = http_build_query(data: $config, arg_separator: ';');
    $dns = "{$driver}:{$config}";

    try {

      $this->connection = new PDO($dns, $username, $password);
    } catch (\PDOException $e) {
      die('Enable to connect to database');
    }
  }

  public function query(string $query, array $params = [])
  {
    $this->connection->query($query);
  }
}
