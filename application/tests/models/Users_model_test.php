<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 13/05/17
 * Time: 21:51
 *
 * @group model
 *
 */
class Users_model_test extends TestCase
{
    /**
     *
     */
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('Users_model');
        $this->obj = $this->CI->Users_model;
    }

    /**
     *
     * Method to create mock, inject it, and call getUsers() method with users id
     *
     */
    public function testGetUsersWithIdFromUsersTableReturnsTheUser()
    {
        $id = 1;
        $row_array = [
            "id" => "1",
            "email" => "flname@site.com",
            "first_name" => "First Name",
            "last_name" => "Last Name",
            "password" => "dc647eb65e6711e155375218212b3964",
            ];

        // Create mock object for CI_DB_result
        $db_result = $this->getMock_CI_DB_result('row_array', $row_array);

        // Create mock object for CI_DB
        $db = $this->getMock_CI_DB(
            'get_where', ['users', ['id' => $id]] , $db_result
        );

        // Inject mock object into the model
        $this->obj->db = $db;

        $item = $this->obj->getUsers($id);
        $this->assertEquals($row_array, $item);
    }

    /**
     *
     * Method to create mock, inject it, and call setUsers() method
     *
     */
    public function testPostDataInsertedIntoUsersTableAndReturn()
    {
        // Create mock object for CI_Input
        $input = $this->getMockBuilder('CI_Input')
            -> disableOriginalConstructor()
            -> getMock();
        // Can't use `$input->method()`, because CI_Input has method() method
        $input->expects($this->any())->method('post')
            ->willReturnMap(
                [
                    // post($index = NULL, $xss_clean = NULL)
                    ['id', null, 0],
                    ['email', null, 'flname@site.com'],
                    ['first_name', null, 'First Name'],
                    ['last_name', null, 'Last Name'],
                    //['password', null, 'Password'],
                ]
            );

        // create mock object for CI_DB
        $db = $this->getMock_CI_DB(
            'insert',
            [
                'users',
                [
                    'id' => 0,
                    'email' => "flname@site.com",
                    'first_name' => "First Name",
                    'last_name' => "Last Name",
                    //'password' => "Password",
                ]
            ],
            true
        );

        // Inject mock objects into the model
        $this->obj->input = $input;
        $this->obj->db = $db;

        $result = $this->obj->setUsers();
        $this->assertTrue($result);
    }

    /**
     * Create Mock Object for CI_DB_result
     *
     * @param string $method method name to mock
     * @param array $return  the return value
     * @return Mock_CI_DB_result_xxxxxxxx
     */
    public function getMock_CI_DB_result($method, $return)
    {
        $db_result = $this->getMockBuilder('CI_DB_result')
            ->disableOriginalConstructor()
            ->getMock();
        $db_result->method($method)->willReturn($return);
        return $db_result;
    }

    /**
     * Create Mock Object for CI_DB
     *
     * @param string $method method name to mock
     * @param array $args    the arguments
     * @param array $return  the return value
     * @return Mock_CI_DB_xxxxxxxx
     */
    public function getMock_CI_DB($method, $args, $return)
    {
        $db = $this->getMockBuilder('CI_DB')
            ->disableOriginalConstructor()
            ->getMock();
        $mocker = $db->expects($this->once())
             ->method($method);

        switch(count($args)) {
            case 1:
                $mocker->with($args[0]);
                break;
            case 2:
                $mocker->with($args[0], $args[1]);
                break;
            case 3:
                $mocker->with($args[0], $args[1], $args[2]);
                break;
            case 4:
                $mocker->with($args[0], $args[1], $args[2], $args[3]);
                break;
            default:
                break;
        }

        $mocker->willReturn($return);

        return $db;
    }
}