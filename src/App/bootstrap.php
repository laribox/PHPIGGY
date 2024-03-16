<?php

declare(strict_types=1);

namespace App;

include __DIR__ . "/../../vendor/autoload.php";
include "functions.php";

use Framework\App;
use App\Config\Paths;

use function App\Config\{registerRoutes, registerMiddleware};

$app = new App(Paths::SOURCE . "App/container-definitions.php");

registerRoutes($app);
registerMiddleware($app);

return $app;
