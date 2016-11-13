<?php

class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include ($routesPath);
    }

    private function getUri () {
        // Получаем строку запроса
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run()
    {
        // Получаем строку запроса
        $uri = $this -> getUri();

        // Проверяем наличие строки запроса в роутах
        foreach ($this -> routes as $uriPattern => $path) {

            // Сравниваем $uriPattern и $uri
            if (preg_match("~$uriPattern~" , $uri)) {

                // Определяем внутренний путь из внешнего согласно правилу

                $internalRoute = preg_replace("~$uriPattern~",$path,$uri);

                // Определяем какой контроллер,экшн, параметры
                $segments = explode('/',$internalRoute);
                $controllerName = ucfirst(array_shift($segments).'Controller');

                $actionName = 'action'.ucfirst(array_shift($segments));
                
                $parameters = $segments;

                // Подключаем файл класса-контроллера
                $controllerFile = ROOT .'/controllers/'.$controllerName .'.php';

                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }

                // Создаем обьект класса контроллера и вызываем метод (экшн)
                $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                if (($result != null) || ($controllerObject instanceof CartController && ($actionName == 'actionDelete' || $actionName == 'actionClean'))) {
                    break;
                }
                else {
                    header("Location: /");
                }

            }

        }
    }
}