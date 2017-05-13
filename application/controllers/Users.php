<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 12/05/17
 * Time: 15:43
 */
class Users extends CI_Controller
{

    /**
     * Users constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->helper('url_helper');
        $this->load->helper('ssl_helper');
        $this->load->helper('email');
    }

    /**
     * Tabulate all users
     */
    public function index()
    {
        $data['users'] = $this->users_model->getUsers();
        $data['title'] = 'Users archive';

        $this->load->view('templates/header', $data);
        $this->load->view('users/index', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Create a user
     */
    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Create a users item';

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        //$this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('users/create');
            $this->load->view('templates/footer');

        }
        else
        {
            $this->users_model->setUsers();
            $this->load->view('templates/header', $data);
            $this->load->view('users/success');
            $this->load->view('templates/footer');
        }
    }

    /**
     * Edit an existing user
     */
    public function edit()
    {
        $id = $this->uri->segment(3);

        if (empty($id))
        {
            show_404();
        }

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Edit a user item';
        $data['users_item'] = $this->users_model->getUsers($id);

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        if ($this->input->post('password'))
        {
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('passconf', 'Password Confirm', 'required|matches[password]');
        }

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('users/edit', $data);
            $this->load->view('templates/footer');

        }
        else
        {
            $this->users_model->setUsers($id);
            //$this->load->view('users/success');
            redirect( base_url() . 'index.php/users');
        }
    }

    /**
     * Delete a user
     */
    public function delete()
    {
        $id = $this->uri->segment(3);

        if (empty($id))
        {
            show_404();
        }

        $users_item = $this->users_model->deleteUsers($id);

        $this->users_model->deleteUsers($id);
        redirect( base_url() . 'index.php/users');
    }
}