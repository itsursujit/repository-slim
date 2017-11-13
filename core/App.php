<?php
/**
 * Created by PhpStorm.
 * User: sujitbaniya
 * Date: 11/12/17
 * Time: 9:01 PM
 */

namespace Main;

use App\Exceptions\Exception;
use App\Helpers\ConfigHelper;
use DI\ContainerBuilder;
use Main\Errors\Handlers\ErrorHandler;
use Psr\Container\ContainerInterface;
use Psr7Middlewares\Middleware\TrailingSlash;
use Slim\HttpCache\CacheProvider;

class App extends \DI\Bridge\Slim\App
{
	protected function configureContainer(ContainerBuilder $builder)
	{
		$builder->useAutowiring(true);
		$definitions = [];
		$definitions = array_merge($definitions, ConfigHelper::get('app'));
		$view = ConfigHelper::get('view');
		if($view['name'] == 'Twig') {
			$definitions = array_merge($definitions, $this->twig());
		}

		$httpCache = ConfigHelper::get('http_cache');
		if($httpCache) {
            $definitions = array_merge($definitions, $this->httpCache());
        }
		//$definitions = array_merge($definitions, $this->uriHandler());

		$builder->addDefinitions($definitions);
	}

	private function twig() {
		$definitions = [

			\Slim\Views\Twig::class => function (ContainerInterface $c) {
                $allowCache = ConfigHelper::get('view')['allow_cache'];
				$twig = new \Slim\Views\Twig(ConfigHelper::get('view')['path'], [
					'cache' => !empty($allowCache)?ConfigHelper::get('view')['cache'] : false
				]);

				$twig->addExtension(new \Slim\Views\TwigExtension(
					$c->get('router'),
					$c->get('request')->getUri()
				));

				return $twig;
			},

		];
		return $definitions;
	}

	public function httpCache() {
        $definitions = [
            'httpCache' => function () {
                return new CacheProvider();
            }
        ];
        return $definitions;
    }


    /**
     * Add GET route
     *
     * @param $method
     * @param  string $pattern The route URI pattern
     * @param $callableMiddleware
     * @param  callable|string $callable The route callback routine
     * @return \Slim\Interfaces\RouteInterface
     * @throws Exception
     */
    public function route($method, $pattern, $callableMiddleware, $callable)
    {
        $route = $this->map([$method], $pattern, $callable);

        if(empty($callableMiddleware)) {
            return $route;
        }
        if(is_array($callableMiddleware)) {
            foreach($callableMiddleware as $value) {
                $route->add($value);
            }
        } else {
            $route->add($callableMiddleware);
        }
        return $route;
    }

    public function uriHandler() {
	    $definitions = [
		    TrailingSlash::class => function () {
			    return new TrailingSlash(true);
		    }
	    ];
	    return $definitions;
    }
}