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
}
