<?php


declare(strict_types=1);


// create class test with function test

class Test
{
  private $counter = 0;
  private $failedCounter = 0;

  public function test()
  {
    echo "Test started\n";
    $this->counter++;
    echo "Counter is {$this->counter}\n";
  }

  public function failed()
  {
    $this->failedCounter++;
  }
}
