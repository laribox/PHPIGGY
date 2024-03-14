<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;

class AboutController
{

  public function __construct(private TemplateEngine $view)
  {
  }
  public function home()
  {
    echo $this->view->render('about.php', [
      'title' => 'Home page',
      'data' => "<script>alert('hello')</script>"
    ]);
  }
}
