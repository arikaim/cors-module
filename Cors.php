<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c) 2017-2018 Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license.html
 * 
*/
namespace Arikaim\Modules\Cors;

use Arikaim\Core\Module\Module;

class Cors extends Module
{
    protected $config = [
        'credentials'   => 'true',
        'origin'        => '*',
        'methods'       => 'POST, GET, OPTIONS, PUT, DELETE',
        'headers'       => 'Origin, Content-Type, Accept, Authorization, X-Request-With, Authorization, Params'
    ];

    public function __construct()
    {
    }

    public function __invoke($request, $response, $next)
    {
        $response = $next($request, $response);
        return $response->withHeader('Access-Control-Allow-Credentials',$this->config['credentials'])
            ->withHeader('Access-Control-Allow-Origin',$this->config['origin'])
            ->withHeader('Access-Control-Allow-Methods',$this->config['methods'])
            ->withHeader('Access-Control-Allow-Headers',$this->config['headers']);
    }
}
