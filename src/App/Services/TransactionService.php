<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

class TransactionService
{
  /**
   * Constructor for the PHP function.
   *
   * @param Database $db description
   */
  public function __construct(private Database $db)
  {
  }

  public function create(array $data)
  {
    $this->db->query(
      "INSERT INTO transactions (description,	amount,	date,	user_id)
                    VALUES (:description, :amount, :date, :user_id)",
      [
        'description' => $data['description'],
        'amount' => $data['amount'],
        'date' => $data['date'],
        'user_id' => $_SESSION['user']
      ]
    );
  }

  public function getUserTransactions(int $length, int $offset)
  {
    $searchTerm = addcslashes($_GET['s'] ?? '', '%_');
    $params = [
      'user_id' => $_SESSION['user'],
      'description' => "%{$searchTerm}%"
    ];

    $transactions = $this->db->query(
      "SELECT *, DATE_FORMAT(date, '%Y-%m-%d') as formatted_date
      FROM transactions 
      WHERE user_id = :user_id
      AND description LIKE :description
      LIMIT {$length} OFFSET {$offset}",
      $params
    )->findAll();

    $transactions = array_map(function (array $transaction) {
      $transaction['receipts'] = $this->db->query(
        "SELECT * FROM receipts WHERE transaction_id = :transaction_id",
        ['transaction_id' => $transaction['id']]
      )->findAll();

      return $transaction;
    }, $transactions);

    $transactionCount = $this->db->query(
      "SELECT COUNT(*)
      FROM transactions 
      WHERE user_id = :user_id
      AND description LIKE :description",
      $params
    )->count();

    return [$transactions, $transactionCount];
  }

  public function getUserTransaction(string $id)
  {
    return $this->db->query(
      "SELECT *, DATE_FORMAT(date, '%Y-%m-%d') as formatted_date
      FROM transactions 
      WHERE id = :id AND user_id = :user_id",
      [
        'id' => $id,
        'user_id' => $_SESSION['user']
      ]
    )->find();
  }


  public function update(array $data, int $id)
  {
    $this->db->query(
      "UPDATE transactions
      SET description = :description, amount = :amount, date = :date
      WHERE id = :id AND user_id = :user_id",
      [
        'description' => $data['description'],
        'amount' => $data['amount'],
        'date' => $data['date'],
        'id' => $id,
        'user_id' => $_SESSION['user']
      ]
    );
  }

  public function delete(int $id)
  {

    $this->db->query(
      "DELETE FROM transactions
      WHERE id = :id AND user_id = :user_id",
      [
        'id' => $id,
        'user_id' => $_SESSION['user']
      ]
    );
  }
}
