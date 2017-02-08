<?php
namespace SRC\Middleware;

use SRC\Exception\BaseException;
use SRC\Exception\InvalidParametersException;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Http\Response;

/**
 * Class ErrorHandler
 * Exception handling middleware invokable class
 *
 * @package SRC\Middleware
 */
class ErrorHandler
{

    /**
     * Exception handling middleware invokable class
     *
     * @param  ServerRequestInterface $request PSR7 request
     * @param  Response $response PSR7 response
     * @param  \Exception $exception The caught exception
     *
     * @return Response
     */
    public function __invoke($request, $response, $exception)
    {
        $code = 500;
        $message = '';
        $log_level = LOG_ERR;

        if ($exception instanceof InvalidParametersException) {
            $code = $exception->getResponseStatusCode();
            $message = $exception->getResponse();
            $log_level = LOG_INFO;
        } elseif ($exception instanceof BaseException) {
            $code = $exception->getResponseStatusCode();
            $message = $exception->getResponse();
        }

        if ($exception instanceof \Exception) {
            if (empty($message)) {
                $message = $exception->getMessage();
            }
            $log_message = get_class($exception) . ' - ' . $exception->getMessage();
        } else {
            $message = $log_message = "Error occured";
        }
        $ret = [
            "error" => 1,
            "message" => $message,
        ];
        return $response->withStatus($code)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode($ret));
    }
}
