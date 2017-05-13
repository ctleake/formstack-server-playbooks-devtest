<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 12/05/17
 * Time: 15:57
 */
class Users_model extends CI_Model {

    /**
     * Users_model constructor.
     */
    public function __construct()
    {
        $this->load->database();
    }

    /**
     * @param bool $id
     * @return mixed
     */
    public function getUsers($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('users');
            return $query->result_array();
        }

        $query = $this->db->get_where('users', array('id' => $id));
        return $query->row_array();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function setUsers($id = 0)
    {
        $data = array(
            'id' => $id,
            'email' => $this->input->post('email'),
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            //'password' => md5($this->input->post('password')),
        );

        if ($password = $this->input->post('password'))
        {
            $data['password'] = md5($password);
        }

        if ($id == 0) {
            return $this->db->insert('users', $data);
        } else {
            $this->db->where('id', $id);
            return $this->db->update('users', $data);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteUsers($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }
}