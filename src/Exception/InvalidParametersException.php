<?php

namespace SRC\Exception;

class InvalidParametersException extends BaseException
{
    protected $responseStatusCode = 400;
    public function __construct($message = null, $code = null, \Exception $previous = null)
    {
        $this->setResponse($message);
        if (is_array($message)) {
            $message = implode('; ', $message);
        }
        parent::__construct($message, $code, $previous);
    }
}
