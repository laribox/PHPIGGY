<?php

declare(strict_types=1);

namespace App\Config;

use App\Controllers\{HomeController, AboutController, AuthController, TransactionController, ReceiptController};
use Framework\App;
use App\Middleware\{AuthRequiredMiddleware, GuestOnlyMiddleware};

/**
 * this function register all routes in the application.
 *
 * @param App $app
 * @return void
 */
function registerRoutes(App $app)
{
  $app->get("/", [HomeController::class, 'home'])->addRouteMiddleware(AuthRequiredMiddleware::class);
  $app->get("/about", [AboutController::class, 'about'])->addRouteMiddleware(AuthRequiredMiddleware::class);
  $app->get("/register", [AuthController::class, 'index'])->addRouteMiddleware(GuestOnlyMiddleware::class);
  $app->post("/register", [AuthController::class, 'register'])->addRouteMiddleware(GuestOnlyMiddleware::class);
  $app->get("/login", [AuthController::class, 'loginView'])->addRouteMiddleware(GuestOnlyMiddleware::class);
  $app->post("/login", [AuthController::class, 'login'])->addRouteMiddleware(GuestOnlyMiddleware::class);
  $app->get("/logout", [AuthController::class, 'logout'])->addRouteMiddleware(AuthRequiredMiddleware::class);
  $app->get('/transaction', [TransactionController::class, 'createView'])->addRouteMiddleware(AuthRequiredMiddleware::class);
  $app->post('/transaction', [TransactionController::class, 'create'])->addRouteMiddleware(AuthRequiredMiddleware::class);
  $app->get('/transaction/{transaction}', [TransactionController::class, 'editView'])->addRouteMiddleware(AuthRequiredMiddleware::class);
  $app->post('/transaction/{transaction}', [TransactionController::class, 'edit'])->addRouteMiddleware(AuthRequiredMiddleware::class);
  $app->delete('/transaction/{transaction}', [TransactionController::class, 'delete'])->addRouteMiddleware(AuthRequiredMiddleware::class);
  $app->get('/transaction/{transaction}/receipt', [ReceiptController::class, 'uploadView'])->addRouteMiddleware(AuthRequiredMiddleware::class);
  $app->post('/transaction/{transaction}/receipt', [ReceiptController::class, 'upload'])->addRouteMiddleware(AuthRequiredMiddleware::class);
}
