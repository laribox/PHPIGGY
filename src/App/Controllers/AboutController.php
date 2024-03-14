<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;

/**
 * About controller class 
 */
class AboutController
{

  /**
   * class constructor
   * @param TemplateEngine $view  inject the TemplateEngine class into the controller class constructor 
   */
  public function __construct(private TemplateEngine $view)
  {
  }
  /**
   * this function is used to render the about page
   *
   * @return void
   */
  public function about()
  {
    echo $this->view->render('about.php', [
      'title' => 'About page',
      'data' => "<script>alert('hello')</script>"
    ]);
  }
}
