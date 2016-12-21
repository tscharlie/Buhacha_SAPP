<?php

class TestCase extends Laravel\Lumen\Testing\TestCase
{
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }
    
    /**
     * Visit the given URI with a GET request.
     *
     * @param  string  $uri
     * @param  array  $headers
     * @return $this
     */
    public function get($uri, array $headers = [], $status = 200)
    {
        $result = parent::get($uri, $headers);
        $this->assertEquals($status, $this->response->getStatusCode());
        return $result;
    }
    
    /**
     * Visit the given URI with a POST request.
     *
     * @param  string  $uri
     * @param  array  $data
     * @param  array  $headers
     * @return $this
     */
    public function post($uri, array $data = [], array $headers = [], $status = 200)
    {
        $result = parent::post($uri, $data, $headers);
        $this->assertEquals($status, $this->response->getStatusCode());
        return $result;
    }
}
