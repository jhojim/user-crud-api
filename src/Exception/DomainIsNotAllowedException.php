<?php

namespace SRC\Exception;

class DomainIsNotAllowedException extends BaseException
{
    protected $response = 'Domain is not allowed';
}
