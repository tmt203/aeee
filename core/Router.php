<?php
namespace app\core;

use app\core\exception\NotfoundException;

class Router
{
  public Request $request;
  public Response $response;
  protected array $routes = [];

  public function __construct(Request $request, Response $response)
  {
    $this->request = $request;
    $this->response = $response;
  }

  public function get($path, $callback)
  {
    $this->routes['get'][$path] = $callback;
  }

  public function post($path, $callback)
  {
    $this->routes['post'][$path] = $callback;
  }

  public function resolve()
  {
    $path = $this->request->getPath();
    $method = $this->request->method();
    $callback = $this->routes[$method][$path] ?? false;

    if ($callback === false) {
      // Check if the path matches a pattern with parameters
      foreach ($this->routes[$method] as $route => $handler) {
        $pattern = preg_replace('/\/:([^\/]+)/', '/([^\/]+)', $route);
        if (preg_match("#^$pattern$#", $path, $matches)) {
          // Extract parameters from the path
          $params = [];
          preg_match_all('/\/:([^\/]+)/', $route, $paramNames);
          array_shift($matches); // Remove the full match
          foreach ($paramNames[1] as $index => $paramName) {
            $params[$paramName] = $matches[$index];
          }

          // Set parameters in the Request class
          $this->request->setParams($params);

          // Call the handler
          if (is_string($handler)) {
            return Application::$app->view->renderView($handler);
          }
          if (is_array($handler)) {
            $controller = new $handler[0]();
            Application::$app->controller = $controller;
            $controller->action = $handler[1];
            $handler[0] = $controller;

            foreach ($controller->getMiddlewares() as $middleware) {
              $middleware->execute();
            }
          }
          return call_user_func_array($handler, [$this->request, $this->response]);
        }
      }

      // If no route matches, throw a 404 exception
      throw new NotFoundException();
    }

    if (is_string($callback)) {
      return Application::$app->view->renderView($callback);
    }
    if (is_array($callback)) {
      /** @var \app\core\Controller $controller */
      $controller = new $callback[0]();
      Application::$app->controller = $controller;
      $controller->action = $callback[1];
      $callback[0] = $controller;

      foreach ($controller->getMiddlewares() as $middleware) {
        $middleware->execute();
      }
    }
    return call_user_func($callback, $this->request, $this->response);
  }
}
?>