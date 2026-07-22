<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * MY_Controller
 * Base controller – all app controllers extend this.
 */
class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Load a view with the standard layout (header + footer).
     *
     * @param string $view   View file path (relative to views/)
     * @param array  $data   Data to pass to the view
     */
    protected function render($view, $data = [])
    {
        // $this->load->view('layout/header', $data);
        $this->load->view($view, $data);
        // $this->load->view('layout/footer', $data);
    }
}

/**
 * Authenticated_Controller
 * Extends MY_Controller and enforces login.
 * All protected controllers extend this.
 */
class Authenticated_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_check_auth();
    }

    private function _check_auth()
    {
        if (!$this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Please login to continue.');
            redirect('login');
        }
    }
}
