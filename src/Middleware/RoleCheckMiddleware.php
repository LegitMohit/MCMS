<?php
declare(strict_types=1);

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Cake\Http\Response;
use Cake\Http\Session;
use Authentication\IdentityInterface;

class RoleCheckMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $identity = $request->getAttribute('identity');
        $path = $request->getUri()->getPath();
        
        // Check if the path contains '/edit/' and user is not admin
        if (strpos($path, '/edit/') !== false || strpos($path, '/delete/') !== false) {
            if (!$identity || $identity->get('role') !== 'admin') {
                // Get session from request
                $session = $request->getAttribute('session');
                if ($session instanceof Session) {
                    $session->write('Flash.error', [
                        'message' => 'Access denied. Only administrators can edit records.',
                        'key' => 'error',
                        'element' => 'flash/error',
                        'params' => []
                    ]);
                }
                
                // Create a response object
                $response = new Response();
                // Redirect to home page with error message
                return $response
                    ->withHeader('Location', '../')
                    ->withStatus(302);
            }
        }
        
        return $handler->handle($request);
    }
} 