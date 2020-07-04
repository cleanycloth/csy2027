<?php
namespace CSY2028;
class EntryPoint {
    private $routes;

    public function __construct(Routes $routes) {
        $this->routes = $routes;
    }

    public function run() {
        $route = ltrim(explode('?', $_SERVER['REQUEST_URI'])[0], '/');

        if ($route != '' && $route[strlen($route)-1] == '/')
            header('Location: /' . rtrim($route, '/'));

		$method = $_SERVER['REQUEST_METHOD'];

		$routes = $this->routes->getRoutes();

		if (isset($routes[$route]['login']))
            $this->routes->checkLogin();
            
        if (isset($routes[$route]['restricted']))
            $this->routes->checkAccess();

        if (isset($routes[$route][$method]['controller']) && isset($routes[$route][$method]['function'])) {
            $controller = $routes[$route][$method]['controller'];
            $functionName = $routes[$route][$method]['function'];
        }
        else {
            http_response_code(404);
            header('Location: /404');
        }

        if (isset($routes[$route][$method]['parameters']))
            $parameters = $routes[$route][$method]['parameters'];
        else
            $parameters = '';
        
        $page = $controller->$functionName($parameters);

        $title = $page['title'];
        $output = $this->loadTemplate('../templates/' . $page['template'], $page['variables']);

        $templateVariables = $this->routes->getTemplateVariables();
        extract($templateVariables);

        require '../templates/' . $page['layout'];
    }

    public function loadTemplate($fileName, $templateVars) {
		extract($templateVars);
		ob_start();
		require $fileName;
		$contents = ob_get_clean();
		return $contents;
	}
}
?>