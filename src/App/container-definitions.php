<?php

declare(strict_types=1);

use Framework\{TemplateEngine, Database, Container};
use App\Config\Paths;
use App\Services\{ReceiptService, TransactionService, ValidatorService, UserService};

/**
 * this file contain the definitions for instantiation for dependency injection 
 */

return [
  TemplateEngine::class => fn () => new TemplateEngine(Paths::VIEW),
  Database::class => fn () => new Database($_ENV['DB_DRIVER'],  [
    'host' => $_ENV['DB_HOST'],
    'port' => $_ENV['DB_PORT'],
    'dbname' => $_ENV['DB_NAME']
  ], $_ENV['DB_USER'], $_ENV['DB_PASS']),
  ValidatorService::class => fn () => new ValidatorService(),
  UserService::class => function (Container $container) {
    $db =  $container->get(Database::class);
    return new UserService($db);
  },
  TransactionService::class => function (Container $container) {
    $db =  $container->get(Database::class);
    return new TransactionService($db);
  },
  ReceiptService::class => function (Container $container) {
    $db =  $container->get(Database::class);
    return new ReceiptService($db);
  }
];
