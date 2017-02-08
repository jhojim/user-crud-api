<?php

namespace SRC\Exception;


class BaseException extends \Exception
{

    protected $response = null;
    /**
     * HTTP status code that should be returned if exception is not caught
     * @var int
     */
    protected $responseStatusCode = 500;

    /**
     * Class constructor
     *
     * @param string|array $message If `string`, it's used as the Exception's message.
     *          If `array`, it requires two items: the first one is the message, the second one
     *          is the params array for uderlying `vsprintf` function. If the first param is `null`,
     *          the object`s `$message` member variable is used instead.
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct($message = "", $code = 0, \Exception $previous = null)
    {
        if (func_num_args() == 0) {
            parent::__construct();
            return;
        }
        if (is_array($message)) {
            $cnt = count($message);
            if ($cnt > 0) {
                $msg = $message[0];
                if (is_null($msg)) {
                    $msg = $this->message;
                }
                if ($msg) {
                    $params = [];
                    if ($cnt > 1) {
                        $params = $message[1];
                    }
                    $message = @vsprintf($msg, $params);
                    if (empty($message)) {
                        throw new \BadMethodCallException('BaseException called with invalid parameters', 500, $this);
                    }
                }
            }
        }
        parent::__construct($message, $code, $previous);
    }

    /**
     * Get response status code
     * @return int
     */
    public function getResponseStatusCode()
    {
        return $this->responseStatusCode;
    }

    /**
     * Set response status code
     * @param $code
     */
    public function setResponseStatusCode($code)
    {
        $this->responseStatusCode = (int)$code;
    }

    /**
     * Set response message
     * @param $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }

    /**
     * Get response message
     * @return string
     */
    public function getResponse()
    {
        return !is_null($this->response) ? $this->response : $this->getMessage();
    }
}