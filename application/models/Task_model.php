<?php
    // defined('BASEPATH') OR exit('No direct script access allowed');
    class Task_model extends CI_model{

        public function get_single_task(){
            $task_id = $this->uri->segment(2);
            $this->db->where('id',$task_id);
            $this->db->where('status','1');
            $this->db->where('is_deleted','0');
            return $this->db->get('tbl_tasks')->row();

        }
        public function set_task(){
                 $data = [
                        'project_id' => $this->input->post('project_id'),
                        'module_id' => $this->input->post('module_id'),
                        'sub_module_id' => $this->input->post('sub_module_id'),
                        'task_title' => $this->input->post('task_title'),
                        'description' => $this->input->post('description'),
                        'user_id' => $this->input->post('user_id'),
                        'hours' => $this->input->post('hours'),
                        'priority' => $this->input->post('priority'),
                        'start_date' => date('Y-m-d',strtotime($this->input->post('start_date'))),
                        'end_date' => date('Y-m-d',strtotime($this->input->post('end_date'))),
                        'description' => $this->input->post('description'),
                 ];

                 $id =  $this->input->post('id');
                 if($id != ''){
                    $this->db->where('id',$id);
                    $this->db->update('tbl_tasks',$data);
                    return 2; // update
                 }else{
                    $data['created_on'] = date('Y-m-d h:i:s');
                    $this->db->insert('tbl_tasks',$data);
                    return 1; // insert
                 }

                 exit;
        }
    }