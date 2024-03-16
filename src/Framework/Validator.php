<?php

declare(strict_types=1);

namespace Framework;

use Framework\Contracts\RuleInterface;

/**
 * this class is used to validate data against a set of rules.
 * it uses the RuleInterface interface to define the rules and their validation logic.
 * it can be used to validate data from a form, a database, or any other source.
 * it can also be used to validate data before saving it to a database.
 * it can be extended to add additional rules and validation logic.
 */
class Validator
{
  private array $rules = [];

  /**
   * this method adds a new rule to the validator.
   *
   * @param string $alias
   * @param RuleInterface $rule
   * @return void
   */
  public function addRule(string $alias, RuleInterface $rule)
  {
    $this->rules[$alias] = $rule;
  }

  /**
   * this method validates the given data against the given rules.
   *
   * @param array $data
   * @param array $fields
   * @return void
   */
  public function validate(array $data, array $fields)
  {
    $errors = [];
    foreach ($fields as $fieldName => $rules) {
      foreach ($rules as $rule) {
        $ruleValidator = $this->rules[$rule];
        if ($ruleValidator->validate($data, $fieldName, [])) {
          continue;
        }
        $errors[$fieldName][] = $ruleValidator->getMessage($data, $fieldName, []);
        //echo "Validation failed for field $fieldName with rule $rule\n";
      }
    }

    if (count($errors) > 0) {
      dd($errors);
    }
  }
}
