<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c)  Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license
 * 
*/
namespace Arikaim\Modules\Cors;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

use Arikaim\Core\Extension\Module;

/**
 * Cors middleware module class
 */
class Cors extends Module implements MiddlewareInterface
{
    /**
     * CORS config
     *
     * @var array
     */
    protected $config = [
        'credentials'   => 'true',
        'origin'        => '*',
        'methods'       => 'GET, POST, PUT, DELETE, PATCH, OPTIONS',
        'headers'       => '*, Authorization'
    ];

    /**
     * Process middleware
     * 
     * @param ServerRequestInterface  $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
    */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {       
        $response = $handler->handle($request);

        return $response
                    ->withHeader('Access-Control-Allow-Credentials',$this->config['credentials'])
                    ->withHeader('Access-Control-Allow-Origin',$this->config['origin'])
                    ->withHeader('Access-Control-Allow-Methods',$this->config['methods'])
                    ->withHeader('Access-Control-Allow-Headers',$this->config['headers']);       
    }
}
