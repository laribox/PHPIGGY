<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\TransactionService;

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
  public function __construct(private TemplateEngine $view, private TransactionService $transactionService)
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
    $page = $_GET['p'] ?? 1;
    $page =  (int) $page;
    $length =   3;
    $offset = ($page - 1) * $length;
    $searchTerm = $_GET['s'] ?? null;



    [$transactions, $count] = $this->transactionService->getUserTransactions($offset, $length);

    $lastPage = ceil($count / $length);
    $pages = [];
    for ($i = 1; $i <= $lastPage; $i++) {
      $pages[$i] = http_build_query(['p' => $i, 's' => $searchTerm]);
    }
    echo $this->view->render(
      'index.php',
      ['transactions' => $transactions, 'currentPage' => $page, 'previousPageQuery' => http_build_query(['p' => $page - 1, 's' => $searchTerm]), 'nextPageQuery' => http_build_query(['p' => $page + 1, 's' => $searchTerm]), 'lastPage' => $lastPage, 'pages' => $pages]
    );
  }
}
