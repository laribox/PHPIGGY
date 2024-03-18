<?php

declare(strict_types=1);

include __DIR__ . '/src/Framework/Database.php';

use Framework\Database;

$db = new Database('mysql',  [
  'host' => 'localhost',
  'port' => 3307,
  'dbname' => 'phpiggy'
], 'root', '');



try {


  $sqlFile = file_get_contents('./database.sql');
  $db->query($sqlFile);
} catch (Exception $e) {

  if ($db->connection->inTransaction()) {
    $db->connection->rollBack();
  }
  echo 'Transaction failed';
}
