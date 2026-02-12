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

use Ork\Pag\Db;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Index route.
 */
class Index extends AbstractRoute
{

    /**
     * The methods to allow for this route.
     */
    final public const array METHODS = ['GET', 'POST'];

    /**
     * The slug for this route.
     */
    final public const string ROUTE = '/';

    /**
     * Invocation implementation.
     */
    #[\Override]
    public function invoke(): Response
    {
        $db = new Db();
        return $this->render(
            'index.twig',
            [
                'post' => (array) $this->request->getParsedBody(),
                'users' => $db->getUsers(),
                'games' => $db->getGames((array) $this->request->getParsedBody()),
            ]
        );
    }

}
