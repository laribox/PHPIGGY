<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use Framework\TemplateEngine;

class TemplateDataMidlleware implements MiddlewareInterface
{

  public function __construct(private TemplateEngine $view)
  {
  }
  public function process(callable $next)
  {
    $this->view->addGlobalTemplateData('title', 'Expense Tracking App');
    $next();
  }
}
