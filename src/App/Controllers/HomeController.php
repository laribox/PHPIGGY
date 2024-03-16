<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;

/**
 * home controller class
 */
class HomeController
{

  /**
   * class constructor.
   *
   * @param TemplateEngine $view iniciated using dependency injection.
   * @return void.
   * @access public.
   */
  public function __construct(private TemplateEngine $view)
  {
  }
  /**
   * this function is used to render the home page.
   *
   * @access public.
   * @return void.
   */
  public function home()
  {
    echo $this->view->render('index.php', []);
  }
}
