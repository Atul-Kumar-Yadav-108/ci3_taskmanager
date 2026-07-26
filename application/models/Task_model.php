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
                'project_id'    => $this->input->post('project_id'),
                'module_id'     => $this->input->post('module_id'),
                'sub_module_id' => $this->input->post('sub_module_id'),
                'task_title'    => $this->input->post('task_title'),
                'description'   => $this->input->post('description'),
                'user_id'       => $this->input->post('user_id'),
                'hours'         => $this->input->post('hours'),
                'priority'      => $this->input->post('priority'),
                'start_date'    => date('Y-m-d', strtotime($this->input->post('start_date'))),
                'end_date'      => date('Y-m-d', strtotime($this->input->post('end_date'))),
                'task_status'   => $this->input->post('task_status'),
            ];

            $id = $this->input->post('id');
            if($id != ''){
                $this->db->where('id', $id);
                $this->db->update('tbl_tasks', $data);
                $this->logs([
                    'task_id' => $id,
                    'user_id' => $this->session->userdata('user_id'),
                    'descriptions'  => 'Task updated',
                    'task_status'  => $this->input->post('task_status'),
                    'created_on' => date('Y-m-d H:i:s')
                ]);
                return 2;
            }else{
                $data['created_on'] = date('Y-m-d H:i:s');
                $this->db->insert('tbl_tasks', $data);
                $this->logs([
                    'task_id' => $this->db->insert_id(),
                    'user_id' => $this->session->userdata('user_id'),
                    'descriptions'  => 'Task created and assigned to ' . $this->session->userdata('user_name'),
                    'task_status'  => $this->input->post('task_status'),
                    'created_on' => date('Y-m-d H:i:s')
                ]);
                return 1;
            }
        }

        // -----------------------------------------------------------------------
        // Private helper — build base WHERE conditions for task queries
        // -----------------------------------------------------------------------
        private function _task_base_where($user_id, $is_admin, $extra_where = [])
        {
            if(!$is_admin){
                $this->db->where('t.user_id', $user_id);
            }
            $this->db->where('t.status', '1');
            $this->db->where('t.is_deleted', '0');
            foreach($extra_where as $col => $val){
                if(is_array($val)){
                    // e.g. ['t.task_status !=' => 'completed']
                    foreach($val as $k => $v){
                        $this->db->where($k, $v);
                    }
                }else{
                    $this->db->where($col, $val);
                }
            }
        }

        // -----------------------------------------------------------------------
        // Private helper — get total count for a task query (no search, no limit)
        // extra_where format: ['column operator' => 'value']  e.g. ['t.end_date <' => '2026-07-26']
        // -----------------------------------------------------------------------
        private function _task_total_count($user_id, $is_admin, $extra_where = [])
        {
            $this->db->select('COUNT(*) AS total');
            $this->db->from('tbl_tasks t');
            $this->db->join('projects p',           't.project_id    = p.id',  'left');
            $this->db->join('tbl_modules m',        't.module_id     = m.id',  'left');
            $this->db->join('tbl_sub_modules sm',   't.sub_module_id = sm.id', 'left');
            if(!$is_admin){
                $this->db->where('t.user_id', $user_id);
            }
            $this->db->where('t.status', '1');
            $this->db->where('t.is_deleted', '0');
            // extra_where keys already contain the operator e.g. 't.end_date <'
            foreach($extra_where as $col => $val){
                $this->db->where($col, $val);
            }
            $row = $this->db->get()->row();
            return $row ? (int)$row->total : 0;
        }

        // -----------------------------------------------------------------------
        public function get_all_tasks(){
            $search   = $this->input->post('search')['value'];
            $user_id  = $this->session->userdata('user_id');
            $is_admin = $this->session->userdata('user_role') == 'admin';

            // -- recordsTotal (no search filter) --
            $total = $this->_task_total_count($user_id, $is_admin);

            // -- recordsFiltered + data --
            $this->db->select('t.id, t.task_title, t.description, t.start_date, t.end_date, t.hours, t.priority, t.status, p.project_name, m.module_name, sm.sub_module_name, t.task_status');
            $this->db->from('tbl_tasks t');
            $this->db->join('projects p',        't.project_id    = p.id',  'left');
            $this->db->join('tbl_modules m',     't.module_id     = m.id',  'left');
            $this->db->join('tbl_sub_modules sm','t.sub_module_id = sm.id', 'left');
            $this->_task_base_where($user_id, $is_admin);
            if($search != ''){
                $this->db->group_start();
                $this->db->like('t.task_title',     $search);
                $this->db->or_like('p.project_name', $search);
                $this->db->or_like('p.project_status',$search);
                $this->db->or_like('m.module_name',  $search);
                $this->db->or_like('sm.sub_module_name',$search);
                $this->db->or_like('t.description',  $search);
                $this->db->group_end();
            }
            $totalFiltered = $this->db->count_all_results('', false);

            $length = $this->input->post('length');
            $start  = $this->input->post('start');
            if($length != -1){
                $this->db->limit($length, $start);
            }

            return [
                'data'     => $this->db->get()->result(),
                'filtered' => $totalFiltered,
                'total'    => $total
            ];
        }

        // -----------------------------------------------------------------------
        public function update_task_status($task_id, $new_status){
            $this->db->where('id', $task_id);
            $this->db->update('tbl_tasks', ['task_status' => $new_status]);
            $task_description = "Task status updated to '$new_status'";
            $this->logs([
                'task_id' => $task_id,
                'user_id' => $this->session->userdata('user_id'),
                'descriptions'  => $task_description,
                'task_status'  => $new_status,
                'created_on' => date('Y-m-d H:i:s')
            ]);
            return $this->db->affected_rows() > 0;
        }

        // -----------------------------------------------------------------------
        public function get_statistics(){
            $user_id  = $this->session->userdata('user_id');
            $is_admin = $this->session->userdata('user_role') == 'admin';

            $this->db->select('
                COUNT(*) AS total_tasks,
                SUM(CASE WHEN task_status = "completed" THEN 1 ELSE 0 END) AS completed_tasks,
                SUM(CASE WHEN task_status = "Pending" OR task_status = "Running" THEN 1 ELSE 0 END) AS in_progress_tasks,
                SUM(CASE WHEN end_date < CURDATE() AND task_status != "completed" THEN 1 ELSE 0 END) AS overdue_tasks
            ');
            $this->db->from('tbl_tasks');
            if(!$is_admin){
                $this->db->where('user_id', $user_id);
            }
            $this->db->where('status', '1');
            $this->db->where('is_deleted', '0');
            return $this->db->get()->row();
        }

        // -----------------------------------------------------------------------
        public function get_all_overdue_tasks(){
            $search   = $this->input->post('search')['value'];
            $user_id  = $this->session->userdata('user_id');
            $is_admin = $this->session->userdata('user_role') == 'admin';

            // -- recordsTotal --
            $total = $this->_task_total_count($user_id, $is_admin, [
                't.end_date <'   => date('Y-m-d'),
                't.task_status !=' => 'completed'
            ]);

            // -- recordsFiltered + data --
            $this->db->select('t.id, t.task_title, t.description, t.start_date, t.end_date, t.hours, t.priority, t.status, p.project_name, m.module_name, sm.sub_module_name, t.task_status');
            $this->db->from('tbl_tasks t');
            $this->db->join('projects p',        't.project_id    = p.id',  'left');
            $this->db->join('tbl_modules m',     't.module_id     = m.id',  'left');
            $this->db->join('tbl_sub_modules sm','t.sub_module_id = sm.id', 'left');
            $this->_task_base_where($user_id, $is_admin);
            $this->db->where('t.end_date <', date('Y-m-d'));
            $this->db->where('t.task_status !=', 'completed');
            if($search != ''){
                $this->db->group_start();
                $this->db->like('t.task_title',     $search);
                $this->db->or_like('p.project_name', $search);
                $this->db->or_like('p.project_status',$search);
                $this->db->or_like('m.module_name',  $search);
                $this->db->or_like('sm.sub_module_name',$search);
                $this->db->or_like('t.description',  $search);
                $this->db->group_end();
            }
            $totalFiltered = $this->db->count_all_results('', false);

            $length = $this->input->post('length');
            $start  = $this->input->post('start');
            if($length != -1){
                $this->db->limit($length, $start);
            }

            return [
                'data'     => $this->db->get()->result(),
                'filtered' => $totalFiltered,
                'total'    => $total
            ];
        }

        // -----------------------------------------------------------------------
        public function get_all_started_tasks(){
            $search   = $this->input->post('search')['value'];
            $user_id  = $this->session->userdata('user_id');
            $is_admin = $this->session->userdata('user_role') == 'admin';

            // -- recordsTotal --
            $total = $this->_task_total_count($user_id, $is_admin, [
                't.task_status' => 'Start'
            ]);

            // -- recordsFiltered + data --
            $this->db->select('t.id, t.task_title, t.description, t.start_date, t.end_date, t.hours, t.priority, t.status, p.project_name, m.module_name, sm.sub_module_name, t.task_status');
            $this->db->from('tbl_tasks t');
            $this->db->join('projects p',        't.project_id    = p.id',  'left');
            $this->db->join('tbl_modules m',     't.module_id     = m.id',  'left');
            $this->db->join('tbl_sub_modules sm','t.sub_module_id = sm.id', 'left');
            $this->_task_base_where($user_id, $is_admin);
            $this->db->where_in('t.task_status', ['start', 'Start']);
            if($search != ''){
                $this->db->group_start();
                $this->db->like('t.task_title',     $search);
                $this->db->or_like('p.project_name', $search);
                $this->db->or_like('p.project_status',$search);
                $this->db->or_like('m.module_name',  $search);
                $this->db->or_like('sm.sub_module_name',$search);
                $this->db->or_like('t.description',  $search);
                $this->db->group_end();
            }
            $totalFiltered = $this->db->count_all_results('', false);

            $length = $this->input->post('length');
            $start  = $this->input->post('start');
            if($length != -1){
                $this->db->limit($length, $start);
            }

            return [
                'data'     => $this->db->get()->result(),
                'filtered' => $totalFiltered,
                'total'    => $total
            ];
        }
        
        public function logs($data){
            $this->db->insert('tbl_task_logs', $data);
            return $this->db->insert_id();
        }
    }
