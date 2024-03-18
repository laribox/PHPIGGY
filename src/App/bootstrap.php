<?php

declare(strict_types=1);

namespace App;

include __DIR__ . "/../../vendor/autoload.php";
include "functions.php";

use Framework\App;
use App\Config\Paths;
use Dotenv\Dotenv;


use function App\Config\{registerRoutes, registerMiddleware};

$dotEnv = Dotenv::createImmutable(Paths::ROOT);
$dotEnv->load();

$app = new App(Paths::SOURCE . "App/container-definitions.php");

registerRoutes($app);
registerMiddleware($app);

return $app;
