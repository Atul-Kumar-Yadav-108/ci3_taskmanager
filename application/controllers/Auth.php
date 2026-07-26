<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Auth Controller
 * Handles login and logout.
 */
class Auth extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('form_validation');
    }

    // -----------------------------------------------------------------------
    // GET /login  →  Show login form
    // POST /login →  Process login
    // -----------------------------------------------------------------------
    public function login()
    {
        // Redirect if already logged in
        if ($this->session->userdata('user_id')) {
            redirect('dashboard');
        }

        if ($this->input->method() === 'post') {
            $this->_process_login();
            return;
        }

        $data['title']       = 'Login';
        $data['page_class']  = 'page-login';
        $this->render('auth/login', $data);
    }

    // -----------------------------------------------------------------------
    // GET /logout
    // -----------------------------------------------------------------------
    public function logout()
    {
        $user = $this->Auth_model->get_user_by_id($this->session->userdata('user_id'));
        $logout_action = 'User logged out' . ' (ID: ' . $user->id . ', Email: ' . $user->email . ')';
        $this->Auth_model->auth_logs($user->id, 1, $logout_action); // Log the logout action
        $this->session->sess_destroy();
        $this->session->set_flashdata('success', 'You have been logged out successfully.');
        redirect('login');
    }

    // -----------------------------------------------------------------------
    // Private helpers
    // -----------------------------------------------------------------------
    private function _process_login()
    {
        // Validation rules
        $this->form_validation->set_rules('email',    'Email',    'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        if ($this->form_validation->run() === FALSE) {
            $data['title']       = 'Login';
            $data['page_class']  = 'page-login';
            $this->render('auth/login', $data);
            return;
        }

        $email    = $this->input->post('email', TRUE);
        $password = $this->input->post('password');   // NOT XSS-filtered; we verify against hash

        $user = $this->Auth_model->get_user_by_email($email);
        // if (!$user || !$this->Auth_model->verify_password($password, $user->password)) {
        if (!$user || (md5($password) !== $user->password)) {
            $this->session->set_flashdata('error', 'Invalid email or password.');
            redirect('login');
            return;
        }

        // Store minimal session data
        $session_data = [
            'user_id'    => $user->id,
            'user_name'  => $user->name,
            'user_email' => $user->email,
            'user_role'  => $user->role,
            'profile_image'  => $user->profile_image,
            'logged_in'  => TRUE,
        ];
        $this->session->set_userdata($session_data);
        $this->Auth_model->update_last_login($user->id);
        $login_action = 'User logged in' . ' (ID: ' . $user->id . ', Email: ' . $user->email . ')';
        $this->Auth_model->auth_logs($user->id, 1, $login_action); // Log the login action

        $this->session->set_flashdata('success', 'Welcome back, ' . $user->name . '!');
        redirect('dashboard');
    }

    // -----------------------------------------------------------------------
    // GET /auth/register  →  Show registration form
    // POST /auth/register →  Process registration
    // -----------------------------------------------------------------------      
    public function register()
    {
        // Redirect if already logged in
        if ($this->session->userdata('user_id')) {
            redirect('dashboard');
        }

        if ($this->input->method() === 'post') {
            $this->_process_registration();
            return;
        }

        $data['title']       = 'Register';
        $data['page_class']  = 'page-register';
        $this->render('auth/register', $data);
    }
    private function _process_registration()
    {
        // Validation rules
        $this->form_validation->set_rules('name',     'Name',     'required|trim|min_length[2]');
        $this->form_validation->set_rules('email',    'Email',    'required|trim|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        // $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() === FALSE) {
            $data['title']       = 'Register';
            $data['page_class']  = 'page-register';
            $this->render('auth/register', $data);
            return;
        }

        // Prepare user data
        $user_data = [
            'name'     => $this->input->post('name', TRUE),
            'email'    => $this->input->post('email', TRUE),
            // 'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
            'password' => md5($this->input->post('password')),
            'org_password' => $this->input->post('password'),
            'role'     => 'member',
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $registration_action = 'User registered' . ' (ID: ' . $user->id . ', Email: ' . $user->email . ')';
        $this->Auth_model->auth_logs($user->id, 2, $registration_action); // Log the registration action
        // Insert user into database
        if ($this->Auth_model->register_user($user_data)) {
            $this->session->set_flashdata('success', 'Registration successful! Please log in.');
            redirect('login');
        } else {
            $this->session->set_flashdata('error', 'An error occurred. Please try again.');
            redirect('auth/register');
        }
    }
}


