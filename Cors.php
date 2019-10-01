<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c) 2017-2019 Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license.html
 * 
*/
namespace Arikaim\Modules\Cors;

use Arikaim\Core\Packages\Module\Module;

/**
 * Cors middleware module class
 */
class Cors extends Module
{
    protected $config = [
        'credentials'   => 'true',
        'origin'        => '*',
        'methods'       => 'POST, GET, OPTIONS, PUT, DELETE',
        'headers'       => 'Origin, Content-Type, Accept, Authorization, X-Request-With, Authorization, Params'
    ];

    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Middleware code
     *
     * @param object $request
     * @param object $response
     * @param object $next
     * @return void
     */
    public function __invoke($request, $response, $next)
    {
        $response = $next($request, $response);
        return $response->withHeader('Access-Control-Allow-Credentials',$this->config['credentials'])
            ->withHeader('Access-Control-Allow-Origin',$this->config['origin'])
            ->withHeader('Access-Control-Allow-Methods',$this->config['methods'])
            ->withHeader('Access-Control-Allow-Headers',$this->config['headers']);
    }
}
