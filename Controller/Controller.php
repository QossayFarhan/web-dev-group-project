<?php

class Controller
{
    /**
     * A function helps in rendering a specified view with variables given
     * 
     * @param string $viewFile View file directory.
     * @param Array $variables An array which stores all the variables passed from controller.
     */
    public function render($viewFile, $variables = [])
    {
        ob_start();
        extract($variables);
        require(__DIR__ . '../../' . $viewFile);
    }
}
?>