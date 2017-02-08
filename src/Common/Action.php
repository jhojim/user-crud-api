<?php

namespace SRC\Common;

abstract class Action
{
    private $request, $response, $args=[];

    public function __construct()
    {
    }

    public function __invoke($request, $response)
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $request->getAttribute('route')->getArguments();

        return $this->dispatch($request, $response, $this->args);
    }


    // The dispatch function calls the requested method in the child class
    // Eg get() for GET requests, post() for POST, etc
    // If a method is not implemented it will return a 501 Not implemented error
    protected function dispatch($request, $response, $args)
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;

        // get, post, put, etc
        $method = strtolower($request->getMethod());

        // Check if child class has this method
        if (!method_exists($this, $method)) {
            // Return error
            return $response->write("Not implemented")->withStatus(501);
        } else {
            $timer = Debug::startTimer(get_class($this) . "::$method");
            // Get response data
            $responseData = $this->$method($request, $response, $args);
            $timer->finish();
            $response = (!is_object($responseData) || get_class($responseData)!='Slim\Http\Response') ?
                Response::format($responseData) : $responseData;

            return $response;
        }
    }


    public function getRequest()
    {
        return $this->request;
    }


    public function getResponse()
    {
        return $this->response;
    }


    public function getArguments()
    {
        return $this->args;
    }


    public function addArgument($name, $val)
    {
        $this->args[$name] = $val;
    }


    // Returns all arguments from query string, post data, route
    public function getAllArguments()
    {
        $values = [];
        if ($this->getRequest()) {
            $values = array_merge($values, $this->getRequest()->getQueryParams());
        }
        $values = array_merge($values, (array)$this->getParsedPostData());
        $values = array_merge($values, $this->getArguments());
        $values = array_filter($values, [$this, 'filterArguments']);
        return $values;
    }

    public function filterArguments($value)
    {
        if (is_array($value)) {
            $value = array_filter($value, [$this, 'filterArguments']);
            return count($value) > 0;
        }
        return $value !== '';
    }


    // Returns raw post data
    public function getPostData()
    {
        $postData = '';
        $body = $this->request ? $this->request->getBody() : false;
        if ($body) {
            $body->rewind();
            $postData = (string)$body->getContents();
        }
        return $postData;
    }


    // Returns parsed post data
    // Parses either json or regular query string format
    public function getParsedPostData()
    {
        $rawPostData = $this->getPostData();

        // First try parsing json
        $data = @json_decode($rawPostData);

        // If failed, try parse_str
        if (!$data) {
            $data = [];
            parse_str($rawPostData, $data);
        }

        return $data;
    }

    // Returns Params
    protected function getParams($values, $options)
    {

        return new Params($values, $options);
    }
}
