<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Auth_model
 * Handles all authentication-related database operations.
 */
class Auth_model extends CI_Model
{
    private $_table = 'users';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Find a user by email.
     *
     * @param  string $email
     * @return object|null
     */
    public function get_user_by_email($email)
    {
        return $this->db
            ->where('email', $email)
            ->where('is_active', 1)
            ->get($this->_table)
            ->row();
    }

    /**
     * Verify password against stored hash.
     *
     * @param  string $password  Plain-text password
     * @param  string $hash      Stored bcrypt hash
     * @return bool
     */
    public function verify_password($password, $hash)
    {
        return password_verify($password, $hash);
    }

    /**
     * Update last_login timestamp.
     *
     * @param int $user_id
     */
    public function update_last_login($user_id)
    {
        $this->db->where('id', $user_id)
                 ->update($this->_table, ['last_login' => date('Y-m-d H:i:s')]);
    }

    public function register_user($data)
    {
        // $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $data['is_active'] = 1; // Set user as active by default
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert($this->_table, $data);
    }

    public function get_user_by_id($user_id)
    {
        return $this->db->where('id', $user_id)->get($this->_table)->row();
    }

    public function update_user($profile_image = null)
    {
        $user_id = $this->session->userdata('user_id');
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'profile_image' => $profile_image
        );

        return $this->db->where('id', $user_id)->update($this->_table, $data);
    }

    public function update_user_password($user_id, $new_password_hashed)
    {
        return $this->db->where('id', $user_id)->update($this->_table, ['password' => $new_password_hashed]);
    }

    public function verify_old_password()
    {
        $user_id = $this->session->userdata('user_id');
        $old_password = $this->input->post('old_password');

        $user = $this->get_user_by_id($user_id);
    
        if ($user && md5($old_password) === $user->password) {
            return true;
        } else {
            return false;
        }
    }
}
