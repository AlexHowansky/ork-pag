<?php

/**
 * Ork PAG
 *
 * @package   Ork\PAG
 * @copyright Alex Howansky (https://github.com/AlexHowansky)
 * @license   https://github.com/AlexHowansky/ork-pag/blob/master/LICENSE MIT License
 * @link      https://github.com/AlexHowansky/ork-pag
 */

namespace Ork\Pag\Route;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Route interface.
 */
interface RouteInterface
{

    /**
     * Invoke a route.
     *
     * @param Request  $request  The request.
     * @param Response $response The response.
     * @param array    $args     The request arguments.
     *
     * @return Response
     */
    public function __invoke(Request $request, Response $response, array $args): Response;

}
