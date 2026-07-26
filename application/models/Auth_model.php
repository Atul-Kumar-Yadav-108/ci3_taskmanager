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
        $user = $this->get_user_by_id($user_id);
        if (!$user) {
            return false; // User not found
        }
        $profile_update_action = '';
        if(!empty($profile_image)){
            $profile_update_action = 'User updated profile image' . ' (ID: ' . $user_id . ', Email: ' . $user->email . ')';
           
        }
        if($user->name != $this->input->post('name')){
            $profile_update_action .= 'User updated name' . ' (ID: ' . $user_id . ', Email: ' . $user->email . ')';
        }
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            // 'profile_image' => $profile_image
        );
        if (!empty($profile_image)) {
            $data['profile_image'] = $profile_image;
        }
        // $profile_update_action = 'User updated profile' . ' (ID: ' . $user_id . ', Email: ' . $this->input->post('email') . ')';
        $this->auth_logs($user_id, 4, $profile_update_action); // Log the profile update action
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

    public function auth_logs($user_id, $action_id, $action)
    {
        $data = [
            'user_id' => $user_id,
            'action_id' => $action_id, // 1 for login,logout, 2 for registration, 3 for password change, 4 for profile update
            'action' => $action,
            'action_date' => date('Y-m-d'),
            'action_time' => date('H-i-s'),
            'created_on' => date('Y-m-d H:i:s')
        ];
        return $this->db->insert('tbl_auth_logs', $data);
    }
}
