<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class TestCase extends Laravel\Lumen\Testing\TestCase
{

    use DatabaseTransactions;

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
     * Setup method
     */
    public function setup()
    {
        parent::setup();
    }

    /**
     * Parent method
     */
    public function teardown()
    {
        parent::teardown();
    }

    /**
     * Convenience method for making
     * a request and asserting the
     * 200 status of a response.
     *
     * @param str   $method
     * @param str   $url
     * @param array $params
     *
     * @return array
     **/
    public function assertOk(
        $method = null,
        $url = null,
        $params = null
    ) {
        $response = $this->makeCall(
            $method,
            $url,
            $params
        );
        $this->assertResponseOk($response);

        $content = json_decode($response->getContent());
        $this->assertNotNull($content);

        return $content;
    }

    /**
     * Convenience method for making
     * a request and asserting the
     * 400 status of a response.
     *
     * @param str   $method
     * @param str   $url
     * @param array $params
     *
     * @return array
     **/
    public function assertBadRequest(
        $method = null,
        $url = null,
        $params = null
    ) {
        $response = $this->makeCall(
            $method,
            $url,
            $params
        );
        $this->assertEquals(400, $response->getStatusCode());

        $content = json_decode($response->getContent());
        $this->assertNotNull($content);

        return $content;
    }

    /**
     * Convenience method for making
     * a request and asserting the
     * 401 status of a response.
     *
     * @param str   $method
     * @param str   $url
     * @param array $params
     *
     * @return array
     **/
    public function assertUnauthorized(
        $method = null,
        $url = null,
        $params = null
    ) {
        $response = $this->makeCall(
            $method,
            $url,
            $params
        );
        $this->assertEquals(401, $response->getStatusCode());

        $content = json_decode($response->getContent());

        return $content;
    }

    /**
     * Convenience method for making
     * a request and asserting the
     * 404 status of a response.
     *
     * @param str   $method
     * @param str   $url
     * @param array $params
     *
     * @return array
     **/
    public function assertNotFound(
        $method = null,
        $url = null,
        $params = null
    ) {
        $response = $this->makeCall(
            $method,
            $url,
            $params
        );
        $this->assertEquals(404, $response->getStatusCode());

        $content = json_decode($response->getContent());
        $this->assertNotNull($content);

        return $content;
    }

    /**
     * Convenience wrapper for using the call method.
     * This method assumes that all requests should
     * be made using an ajax header.
     *
     * Any additional code regarding the
     * calls shoud be place here.
     *
     * @param str   $method
     * @param str   $url
     * @param array $params
     *
     * @return Response
     **/
    private function makeCall(
        $method = null,
        $url = null,
        $params = null
    ) {
        if (!$method) {
            $method = 'GET';
        }
        if (!$url) {
            $url = '/';
        }
        if (!$params) {
            $params = array();
        }

        $server = array(
            'HTTP_X-Requested-With' => 'XMLHttpRequest',
        );

        $response = $this->call(
            $method,
            $url,
            $params,
            $cookies = array(),
            $files = array(),
            $server
        );

        if ($response->getStatusCode() == 500) {
            echo($response->getContent());
        }

        return $response;
    }
}

