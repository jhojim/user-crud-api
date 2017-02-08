<?php

namespace SRC\Exception;

class ParametersConfigurationException extends BaseException
{
    protected $response = 'Internal server error';
    protected $message = 'Invalid parameters configuration';
}
