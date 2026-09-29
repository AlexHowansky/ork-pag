<?php

/**
 * Ork PAG
 *
 * @package   Ork\PAG
 * @copyright Alex Howansky (https://github.com/AlexHowansky)
 * @license   https://github.com/AlexHowansky/ork-pag/blob/master/LICENSE MIT License
 * @link      https://github.com/AlexHowansky/ork-pag
 */

namespace Ork\Pag;

use Ork\Pag\Route\Index;
use Psr\Container\ContainerInterface;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

/**
 * App class.
 */
class App
{

    /**
     * The Slim app.
     *
     * @var \Slim\App<ContainerInterface|null>
     */
    protected \Slim\App $app;

    /**
     * Create new application.
     */
    public function __construct()
    {
        $this->app = AppFactory::create();
        $this->registerView()->registerRoutes([Index::class]);
        $this->app->addRoutingMiddleware();
        $this->app->addErrorMiddleware(false, true, true);
    }

    /**
     * Register the routes for this app.
     *
     * @param array $routes The list of routes to register.
     *
     * @return App Allow method chaining.
     */
    protected function registerRoutes(array $routes): App
    {
        foreach ($routes as $route) {
            $this->app->map($route::METHODS, $route::ROUTE, $route);
        }
        return $this;
    }

    /**
     * Register the view component.
     *
     * @return App Allow method chaining.
     */
    protected function registerView(): App
    {
        $twig = Twig::create(
            (string) realpath(__DIR__ . '/../templates'),
            ['cache' => false]
        );
        $this->app->add(TwigMiddleware::create($this->app, $twig));
        return $this;
    }

    /**
     * Run the application.
     */
    public function run(): void
    {
        $this->app->run();
    }

}
