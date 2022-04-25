<?php

class Route
{
    private static $routes = [];
    private static $not_found = true;

    /**
     * Add route into $routes array
     * 
     * @param string $method    The request method such as POST, GET, etc.
     * @param string $route     The URI of a route.
     * @param string $function  A specific class name and function name with the format of 'ClassName@FunctionName'.
     */
    public static function add($method, $route, $function, $loginRequired = true)
    {
        try
        {    
            self::$routes[] = [
                'method' => $method,
                'route'  => $route,
                'function'=> $function,
                'loginRequired'=> $loginRequired
            ];
        }
        catch(Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Route request to a specific class function according to the routes given in index.php
     */
    public static function route()
    {
        try
        {
            // Read the current request URI.
            $request = $_SERVER['REQUEST_URI'];

            // Remove the root folder name from the URI.
            $uri = str_replace('/'.ROOT_FOLDER_NAME, '', $request);
            $uri = explode('?', $uri);
            $uri = $uri[0];

            // Read the current request method. Example: POST, GET, etc.
            $method = $_SERVER['REQUEST_METHOD'];

            foreach(self::$routes as $route)
            {
                // If the specified URI and method are found.
                if($uri == $route['route'] && $method == $route['method'])
                {
                    // Set the not_found flag to false.
                    self::$not_found = false;

                    // Read the specified function name & class name, and separate them by symbol '@'.
                    $function = explode('@', $route['function']);
                    $className = $function[0];
                    $functionName = $function[1];

                    // Check if the route requires login or not, if it does and the user haven't login yet then redirect them to login page.
                    session_start();
                    if($route['loginRequired'])
                    {
                        if(!isset($_SESSION['email']))
                        {
                            header("Location: /".ROOT_FOLDER_NAME."/login");
                        }
                        else if(!$_SESSION['admin'] && !in_array($uri, ['/dashboard', '/profile', '/checkin', '/updateProfile', '/shiftList', '/logout']))
                        {
                            header("Location: /".ROOT_FOLDER_NAME."/dashboard");
                        }
                    }
                    // If user has login into system, route all non login-required page to dashboard, exp: login page.
                    else
                    {
                        if(isset($_SESSION['email']))
                        {
                            header("Location: /".ROOT_FOLDER_NAME."/dashboard");
                        }
                    }

                    // Instantiate the specified class.
                    $class = new $className();

                    // Call the specified class's function.
                    call_user_func_array( [$class, $functionName], []);

                    break;
                }
            }
            // If the not_found flag is true, route user to 404 not found page.
            if(self::$not_found){
                http_response_code(404);
                require __DIR__ . '../../Views/404.php';
            }
        }
        catch(Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }
}
?>