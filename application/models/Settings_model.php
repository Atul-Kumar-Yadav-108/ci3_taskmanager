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
}
?>