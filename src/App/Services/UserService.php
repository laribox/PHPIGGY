<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException;

class UserService
{
  /**
   * Constructor for the PHP function.
   *
   * @param Database $db description
   */
  public function __construct(private Database $db)
  {
  }

  public function isEmailRegistered(string $email)
  {
    $result = $this->db->query('SELECT COUNT(*) FROM users WHERE email = :email', ['email' => $email]);
    if ($result->count() > 0) {
      throw new ValidationException(['email' => ['Email taken']]);
    }
  }

  public function create(array $data)
  {
    $this->db->query(
      "INSERT INTO users (email,password,age,country,social_media_url)
                    VALUES (:email, :password, :age, :country, :url)",
      [
        'email' => $data['email'],
        'password' => password_hash($data['password'], PASSWORD_BCRYPT),
        'age' => $data['age'],
        'country' => $data['country'],
        'url' => $data['socialMediaURL']
      ]
    );

    session_regenerate_id();
    $_SESSION['user'] = $this->db->id();
  }

  public function login(array $data)
  {
    $user = $this->db->query("SELECT * FROM users WHERE email= :email ", ['email' => $data['email']])->find();
    $matchPassword = password_verify($data['password'], $user['password'] ?? '');

    if (!$user || !$matchPassword) {
      throw new ValidationException(['password' => ['Wrong email or password']]);
    }
    session_regenerate_id();

    $_SESSION['user'] = $user['id'];
  }


  public function isEmailTaken(string $email)
  {
    $emailCount = $this->db->query(
      "SELECT COUNT(*) FROM users WHERE email = :email",
      [
        'email' => $email
      ]
    )->count();

    if ($emailCount > 0) {
      throw new ValidationException(['email' => ['Email taken']]);
    }
  }

  public function logout()
  {
    unset($_SESSION['user']);
    session_regenerate_id();
  }
}
