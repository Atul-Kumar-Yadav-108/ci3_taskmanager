<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SettingsController extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('Settings_model');
    }

    public function settings_log()
    {
        // Check if the user is an admin
        if ($this->session->userdata('user_role') !== 'admin') {
            // show_error('You do not have permission to access this page.', 403);
            $this->session->set_flashdata('error', 'You do not have permission to access this page.');
            redirect('/'); // Redirect to dashboard or any other page   
        }

        $data['title'] = 'Settings Log';
        $data['page_class'] = 'page-settings-log';
        $data['settings_logs'] = $this->Settings_model->get_settings_logs();
        // echo "<pre>"
        // print_r($data['settings_logs']); // Debugging line to check the data
        // exit;
        $this->render('settings/settings_log', $data);
    }
    
    public function profile_update_log()
    {
        // Check if the user is an admin
        // if ($this->session->userdata('user_role') !== 'admin') {
        //     // show_error('You do not have permission to access this page.', 403);
        //     $this->session->set_flashdata('error', 'You do not have permission to access this page.');
        //     redirect('/'); // Redirect to dashboard or any other page   
        // }

        $data['title'] = 'Profile Update Log';
        $data['page_class'] = 'page-profile-update-log';
        // $data['settings_logs'] = $this->Settings_model->get_profile_update_logs();
        // echo "<pre>"
        // print_r($data['settings_logs']); // Debugging line to check the data
        // exit;
        $this->render('settings/profile_updated_log', $data);
    }

    public function password_change_log()
    {
        // Check if the user is an admin
        if ($this->session->userdata('user_role') !== 'admin') {
            // show_error('You do not have permission to access this page.', 403);
            $this->session->set_flashdata('error', 'You do not have permission to access this page.');
            redirect('/'); // Redirect to dashboard or any other page   
        }

        $data['title'] = 'Password Change Log';
        $data['page_class'] = 'page-password-change-log';
        // $data['settings_logs'] = $this->Settings_model->get_password_change_logs();
        // echo "<pre>"
        // print_r($data['settings_logs']); // Debugging line to check the data
        // exit;
        $this->render('settings/password_change_log', $data);
    }

    public function settings_update()
    {
        // Check if the user is an admin
        if ($this->session->userdata('user_role') !== 'admin') {
            // show_error('You do not have permission to access this page.', 403);
            $this->session->set_flashdata('error', 'You do not have permission to access this page.');
            redirect('/'); // Redirect to dashboard or any other page
        }

        $data['title'] = 'Update Settings';
        $data['page_class'] = 'page-settings-update';
        $this->render('settings/settings_update', $data);
    }

    public function notifications()
    {
        // Check if the user is an admin
        // if ($this->session->userdata('user_role') !== 'admin') {
        //     // show_error('You do not have permission to access this page.', 403);
        //     $this->session->set_flashdata('error', 'You do not have permission to access this page.');
        //     redirect('/'); // Redirect to dashboard or any other page   
        // }

        $data['title'] = 'Notifications';
        $data['page_class'] = 'page-notifications';
        // $data['settings_logs'] = $this->Settings_model->get_notifications();
        
        // echo "<pre>";
        // print_r($data['settings_logs']); // Debugging line to check the data
        // exit;
        $this->render('settings/notifications', $data);
    }

    public function mark_all_as_read()
    {
        // Check if the user is an admin
        // if ($this->session->userdata('user_role') !== 'admin') {
        //     // show_error('You do not have permission to access this page.', 403);
        //     $this->session->set_flashdata('error', 'You do not have permission to access this page.');
        //     redirect('/'); // Redirect to dashboard or any other page   
        // }

        $this->Settings_model->mark_all_notifications_as_read();
        $this->session->set_flashdata('success', 'All notifications marked as read.');
        redirect('notifications');
    }

    public function notification_details()
    {
        // $id = $this->uri->segment(3);
        $data['title'] = 'Notification Details';
        $data['page_class'] = 'page-notifications';
        $data['notification'] = $this->Settings_model->get_notification_details();
        // echo "<pre>";
        // print_r($data['notification']); // Debugging line to check the data
        // exit;
        $this->render('settings/notification_details', $data);
    }
}

?>