<?php

declare(strict_types=1);

namespace App\Config;

use App\Controllers\{HomeController, AboutController, AuthController};
use Framework\App;

/**
 * this function register all routes in the application.
 *
 * @param App $app
 * @return void
 */
function registerRoutes(App $app)
{
  $app->get("/", [HomeController::class, 'home']);
  $app->get("/about", [AboutController::class, 'about']);
  $app->get("/register", [AuthController::class, 'index']);
  $app->post("/register", [AuthController::class, 'register']);
}
