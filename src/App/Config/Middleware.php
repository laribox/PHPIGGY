<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Middleware\TemplateDataMidlleware;

function registerMiddleware(App $app)
{
  $app->addMiddleware(TemplateDataMidlleware::class);
}
