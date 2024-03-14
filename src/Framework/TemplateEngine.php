<?php

declare(strict_types=1);

namespace Framework;

/**
 * This class is responsible for rendering templates.
 */
class TemplateEngine
{
  public function __construct(private string $basePath)
  {
  }

  /**
   * this function renders the template and returns the output as a string.
   * it takes a template name and an array of data as arguments.
   * it extracts the data into the local scope and includes the template.
   * it returns the output of the template as a string.
   * it uses the extract() function to extract the data into the local scope.
   * it uses the ob_start() function to start the output buffer.
   * it includes the template.
   * it gets the output from the buffer using the ob_get_contents() function.
   * it clears the buffer using the ob_end_clean() function.
   * it returns the output of the template as a string.
   *
   * @param string $template
   * @param array $data
   * @return string
   */
  public function render(string $template, array $data = [])
  {
    extract($data);
    ob_start();

    include $this->resolve($template);
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
  }
  /**
   * Resolves the path to the template.
   *
   * @param string $path
   * @return void
   */
  public function resolve(string $path)
  {
    return "{$this->basePath}/{$path}";
  }
}
