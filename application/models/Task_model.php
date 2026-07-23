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
                        'task_status' => $this->input->post('task_status'),
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

        public function get_all_tasks(){
            $search = $this->input->post('search')['value'];

            $this->db->select('t.id, t.task_title, t.description, t.start_date, t.end_date, t.hours, t.priority, t.status, p.project_name, m.module_name, sm.sub_module_name, t.task_status');
            $this->db->from('tbl_tasks t');
              if($search != '')
               {
                  $this->db->group_start();

                  $this->db->like('t.task_title',$search);
                  $this->db->or_like('p.project_name',$search);
                  $this->db->or_like('p.project_status',$search);
                  $this->db->or_like('m.module_name',$search);
                  $this->db->or_like('sm.sub_module_name',$search);
                  $this->db->or_like('t.description',$search);

                  $this->db->group_end();
               }
            $this->db->join('projects p', 't.project_id = p.id', 'left');
            $this->db->join('tbl_modules m', 't.module_id = m.id', 'left');
            $this->db->join('tbl_sub_modules sm', 't.sub_module_id = sm.id', 'left');
            $this->db->where('t.status', '1');
            $this->db->where('t.is_deleted', '0');
            $totalFiltered = $this->db->count_all_results('',false);
            
            $length = $this->input->post('length');
            $start  = $this->input->post('start');

               if($length != -1)
               {
                  $this->db->limit($length,$start);
               }

            
               return [
                  'data'=>$this->db->get()->result(),
                  'filtered'=>$totalFiltered,
                  'total'=>$this->db->count_all('tbl_tasks')
               ];
        }
    }