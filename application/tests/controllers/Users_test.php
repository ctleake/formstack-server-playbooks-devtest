<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 14/05/17
 * Time: 12:59
 *
 * @group controller
 *
 */
class Users_test extends TestCase
{
    /**
     * Method to test default route
     */
    public function testAccessToRootShowsIndex()
    {
        $output = $this->request('GET', '/');
        $this->assertContains('<h2>Users archive</h2>', $output);
    }

    /**
     * Method to test request for unsuported page gives 404
     */
    public function testAccessNotfoundShow404()
    {
        $output = $this->request('GET', 'notfound');
        $this->assertResponseCode(404);
    }

    /**
     * Method to test successful creation of a user
     */
    public function testPostingValidUserShowsSuccessfulMessage()
    {
        $this->request->setCallable(
            function ($CI) {
                $users_model = $this->getDouble(
                    'Users_model', ['setUsers' => true]
                );
                $CI->users_model = $users_model;
            }
        );

        $output = $this->request(
            'POST',
            '/users/create',
            [
                'email' => 'flname@site.com',
                'first_name' => 'CodeIgniter Controllers',
                'last_name' => 'Are So Easy To Test!',
                'password' => 'Password',
                'passconf' => 'Password',
            ]
        );
        $this->assertContains('<p>User added successfully!</p>', $output);
    }

    /**
     * Method to test error handling in user creation
     */
    public function testPostInvalidUserDataShowsErrorMessages()
    {
        $output = $this->request(
            'POST',
            '/users/create',
            [
                'email' => 'jhsgfjhg',
            ]
        );
        $this->assertContains('<p>The Email field must contain a valid email address.</p>', $output);
        $this->assertContains('<p>The First Name field is required.</p>', $output);
        $this->assertContains('<p>The Last Name field is required.</p>', $output);
        $this->assertContains('<p>The Password field is required.</p>', $output);
        $this->assertContains('<p>The Password Confirm field is required.</p>', $output);
    }
}