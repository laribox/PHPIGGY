<?php

declare(strict_types=1);

use Framework\TemplateEngine;
use App\Config\Paths;

/**
 * this file contain the definitions for instantiation for dependency injection 
 */

return [
  TemplateEngine::class => fn () => new TemplateEngine(Paths::VIEW),

];
