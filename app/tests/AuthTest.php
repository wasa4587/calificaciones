<?php

class AuthTest extends TestCase {

    private $userData;
    private $credentials;

    public function setUp()
    {
        parent::setUp();

        $this->userData = [
            'email' => 'test@email.com',
            'username' => 'testuser',
            'name' => 'Test Name',
            'password' => 'testpassword',
        ];
        $response = $this->callAPI('POST', 'users', $this->userData);
        $this->credentials = array_only($this->userData, ['username', 'password']);
    }

    /**
     * @expectedException        AuthTokenNotAuthorizedException
     * @expectedExceptionMessage Not Authorized
     * @expectedExceptionCode    401
     */
    public function testLoginFails()
    {
        $response = $this->callAPI('POST', 'auth');
    }

    public function testLogin()
    {
        $response = $this->callAPI('POST', 'auth', $this->credentials);
        $this->assertResponseOk();
        $this->assertRegExp('/\w+/', $response->token);
    }

    public function testLoginAndRequest()
    {
        $response = $this->callAPI('POST', 'auth', $this->credentials);
        $this->assertResponseOk();

        $user = $this->callAPI('GET', 'auth', ['auth_token' => $response->token]);
        $this->assertResponseOk();
        $this->assertEquals($this->userData['username'], $user->username);
        $this->assertEquals($this->userData['name'], $user->name);

        $user = $this->callAPI('GET', 'auth', [], [], ['HTTP_X_AUTH_TOKEN' => $response->token]);
        $this->assertResponseOk();
        $this->assertEquals($this->userData['username'], $user->username);
        $this->assertEquals($this->userData['name'], $user->name);
    }

    /**
     * @expectedException        AuthTokenNotAuthorizedException
     * @expectedExceptionMessage Not Authorized
     * @expectedExceptionCode    401
     */
    public function testLogoutFails()
    {
        $response = $this->callAPI('DELETE', 'auth');
    }

    public function testLoginThenLogout()
    {
        $response = $this->callAPI('POST', 'auth', $this->credentials);

        $this->callAPI('GET', 'auth', ['auth_token' => $response->token]);
        $this->assertResponseOk();

        $this->callAPI('DELETE', 'auth', ['auth_token' => $response->token]);
        $this->assertResponseOk();

        $this->setExpectedException('AuthTokenNotAuthorizedException', 'Not Authorized', 401);
        $this->callAPI('GET', 'auth', ['auth_token' => $response->token]);
    }
}
