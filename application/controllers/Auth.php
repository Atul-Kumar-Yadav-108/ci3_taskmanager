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

        if (!$user || !$this->Auth_model->verify_password($password, $user->password)) {
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
            'logged_in'  => TRUE,
        ];
        $this->session->set_userdata($session_data);

        $this->Auth_model->update_last_login($user->id);

        $this->session->set_flashdata('success', 'Welcome back, ' . $user->name . '!');
        redirect('dashboard');
    }
}
