<?php

class UsersTest extends TestCase {

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testCreateUser()
    {
        $data = [
            'email' => 'testuser@email.com',
            'username' => 'testuser',
            'name' => 'testuser',
            'password' => 'testpassword',
        ];

        $user = $this->callAPI('POST', 'users', $data);
        $this->assertResponseStatus(201);

        $this->assertNotEmpty($user->id);
        $this->assertEquals($data['email'], $user->email);
        $this->assertEquals($data['username'], $user->username);
        $this->assertEquals($data['name'], $user->name);

        $data = [
            'email' => 'testuser2@email.com',
            'username' => 'testuser2',
            'name' => 'testuser2',
            'password' => 'testpassword',
            'is_admin' => true,
        ];

        $user = $this->callAPI('POST', 'users', $data);
        $this->assertResponseStatus(201);

        $this->assertNotEmpty($user->id);
        $this->assertEquals($data['email'], $user->email);
        $this->assertEquals($data['username'], $user->username);
        $this->assertEquals($data['name'], $user->name);

    }
    public function testCreateUserFails()
    {
        $user = $this->callAPI('POST', 'users', []);
        $this->assertResponseStatus(400);

        $errors = json_decode(json_encode($user->errors), true);
        $this->assertNotEmpty(array_get($errors, 'email.required'));
        $this->assertNotEmpty(array_get($errors, 'username.required'));
        $this->assertNotEmpty(array_get($errors, 'name.required'));
        $this->assertNotEmpty(array_get($errors, 'password.required'));

        $user = $this->callAPI('POST', 'users', ['email' => 'invalid', 'password' => '12345']);
        $this->assertResponseStatus(400);

        $errors = json_decode(json_encode($user->errors), true);
        $this->assertNotEmpty(array_get($errors, 'email.email'));
        $this->assertNotEmpty(array_get($errors, 'password.min'));

        list($user, $token) = $this->createUser();

        $data = [
            'email' => 'testuser@email.com',
            'username' => 'testuser2',
            'name' => 'testuser',
            'password' => 'testpassword',
        ];
        $user = $this->callAPI('POST', 'users', $data);
        $this->assertResponseStatus(400);

        $errors = json_decode(json_encode($user->errors), true);
        $this->assertNotEmpty(array_get($errors, 'email.unique'));
        $this->assertEmpty(array_get($errors, 'username.unique'));

        $data = [
            'email' => 'testuser2@email.com',
            'username' => 'testuser',
            'name' => 'testuser',
            'password' => 'testpassword',
        ];
        $user = $this->callAPI('POST', 'users', $data);
        $this->assertResponseStatus(400);

        $errors = json_decode(json_encode($user->errors), true);
        $this->assertEmpty(array_get($errors, 'email.unique'));
        $this->assertNotEmpty(array_get($errors, 'username.unique'));
    }
}
