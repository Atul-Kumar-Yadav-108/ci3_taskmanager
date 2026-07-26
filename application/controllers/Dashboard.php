<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Dashboard Controller
 * Protected – requires login.
 */
class Dashboard extends Authenticated_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title']      = 'Add Task';
        $data['page_class'] = 'page-task';
        $statistics = $this->Task_model->get_statistics();
        $data['statistics'] = $statistics;
        // echo "<pre>";
        // print_r($data);
        // exit;
        $this->render('dashboard/index', $data);
    }


    
    // -----------------------------------------------------------------------
    // GET /dashboard/profile  →  Show user profile
    // -----------------------------------------------------------------------
    public function profile()
    {
        // Ensure user is logged in
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        if($this->form_validation->run() === FALSE) {
            $user_id = $this->session->userdata('user_id');
            $data['user'] = $this->Auth_model->get_user_by_id($user_id);

            $data['title']       = 'Profile';
            $data['page_class']  = 'page-profile';
            $this->load->view('dashboard/profile', $data);
        }else{
            $profile_image = null;
            if(!empty($_FILES['profile_image']['name']))
            {
                $config['upload_path']   = './uploads/profile_images/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
                $config['encrypt_name']  = TRUE;

                $this->load->library('upload', $config);

                if($this->upload->do_upload('profile_image'))
                {
                    $uploadData = $this->upload->data();

                    $profile_image = $uploadData['file_name'];
                }
                else
                {
                    echo $this->upload->display_errors();
                    exit;
                }
            }

            if($this->Auth_model->update_user($profile_image)) {
                $this->session->set_flashdata('success', 'Profile updated successfully.');
            } else {
                $this->session->set_flashdata('error', 'An error occurred while updating your profile. Please try again.');
            }
            redirect('profile');
        }

    }

    public function update_password()
    {
        // Ensure user is logged in
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }

        $this->form_validation->set_rules('old_password', 'Current Password', 'required');
        $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_new_password', 'Confirm Password', 'required|matches[new_password]');

        if ($this->form_validation->run() === FALSE) {
            $data['title']       = 'Update Password';
            $data['page_class']  = 'page-update-password';
            $this->load->view('dashboard/update_password', $data);
        } else {
            $user_id = $this->session->userdata('user_id');
            $user = $this->Auth_model->get_user_by_id($user_id);

            if (!$user || (md5($this->input->post('old_password')) !== $user->password)) {
                $this->session->set_flashdata('error', 'Current password is incorrect.');
                redirect('update_password');
                return;
            }

            $new_password_hashed = md5($this->input->post('new_password'));
            if ($this->Auth_model->update_user_password($user_id, $new_password_hashed)) {
                $this->session->set_flashdata('success', 'Password updated successfully.');
            } else {
                $this->session->set_flashdata('error', 'An error occurred while updating your password. Please try again.');
            }
            redirect('update_password');
        }
    }

    public function verify_old_password(){
        $this->output->set_content_type('application/json');
        $isValid = $this->Auth_model->verify_old_password();
        return $this->output->set_output(json_encode(['valid' => $isValid]));
        exit;
    }
}
