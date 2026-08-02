<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_settings_logs()
    {
        // Implementation for fetching settings logs
        $this->db->select('*');
        $this->db->from('tbl_auth_logs');
        $this->db->order_by('created_on', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // public function get_profile_update_logs()
    // {
    //     // Implementation for fetching profile update logs
    //     $this->db->select('*');
    //     $this->db->from('tbl_auth_logs');
    //     $this->db->where('action_id', '2'); // Assuming 2 is the ID for profile update actions
    //     $this->db->order_by('created_on', 'DESC');
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    public function get_notifications()
    {
        // Implementation for fetching notifications
        if( $this->session->userdata('user_role') !== 'admin') {
            $this->db->where('user_id', $this->session->userdata('user_id'));   
        }
        $this->db->select('*');
        $this->db->from('tbl_task_logs');
        $this->db->order_by('created_on', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function mark_all_notifications_as_read()
    {
        // Implementation for marking all notifications as read
        // if( $this->session->userdata('user_role') !== 'admin') {
            $this->db->where('user_id', $this->session->userdata('user_id'));   
        // }
        $this->db->update('tbl_task_logs', array('is_read' => '1'));
    }

    public function unreadNotificationsCount()
    {
        // Implementation for getting unread notifications count
        if( $this->session->userdata('user_role') !== 'admin') {
            $this->db->where('user_id', $this->session->userdata('user_id'));
        }
        $this->db->where('is_read', '0');
        return $this->db->count_all_results('tbl_task_logs');
    }

    public function get_notification_details()
    {

        $id = $this->uri->segment(2);
        $this->db->where('id', $id);
        $this->db->update('tbl_task_logs', array('is_read' => '1'));
        // Implementation for fetching notification details
        $this->db->select('t.*,tt.task_title, tt.description, u.name as user_name, u.email as user_email');
        $this->db->from('tbl_task_logs t');
        $this->db->join('users u', 't.user_id = u.id', 'left');
        $this->db->join('tbl_tasks tt', 't.task_id = tt.id', 'left');
        $this->db->where('t.id', $id);
        $query = $this->db->get();
        return $query->row();
    }
}
?>