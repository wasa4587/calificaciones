<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {
    protected $token;
    protected $api_version = 'v1';

    /**
     * Creates the application.
     *
     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication()
    {
        $unitTesting = true;

        $testEnvironment = 'testing';

        return require __DIR__.'/../../bootstrap/start.php';
    }

    public function setUp()
    {
        parent::setUp();

        BaseModel::resetBooted();

        $this->app->make('artisan')->call('migrate:refresh');
    }

    public function callAPI($method, $uri, array $parameters = array(), array $files = array(), array $server = array())
    {
        if (0 !== strpos($uri, '/')) {
            $uri = '/'.$this->api_version .'/'. $uri;
        }

        if ($this->token) {
            $parameters['auth_token'] = $this->token;
        }
        $response = $this->call($method, $uri, $parameters, $files, $server);
        return json_decode($response->getContent());
    }
    public function createUser()
    {
        $data = [
            'email' => 'testuser@email.com',
            'username' => 'testuser',
            'name' => 'testuser',
            'password' => 'testpassword',
        ];

        $user = $this->callAPI('POST', 'users', $data);
        $this->assertResponseStatus(201);
        return [$user, '1'];
    }
}
