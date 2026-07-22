<?php
    // defined('BASEPATH') OR exit('No direct script access allowed');
    class Project_model extends CI_model{
            public function set_project(){
                //  echo "<pre>";print_r($_POST);exit;
                 $data = [
                        'project_name' => $this->input->post('project_name'),
                        'project_code' => $this->input->post('project_code'),
                        'start_date' => date('Y-m-d',strtotime($this->input->post('start_date'))),
                        'end_date' => date('Y-m-d',strtotime($this->input->post('end_date'))),
                        'project_status' => $this->input->post('project_status'),
                        'description' => $this->input->post('description'),
                 ];

                 $id =  $this->input->post('id');
                 if($id != ''){
                    $this->db->where('id',$id);
                    $this->db->update('projects',$data);
                    return 2; // update
                 }else{
                    $data['created_on'] = date('Y-m-d h:i:s');
                    $this->db->insert('projects',$data);
                    return 1; // insert
                 }

                 exit;
            }

            public function get_all_projects()
            {
               $search = $this->input->post('search')['value'];

               $this->db->from('projects');

               if($search != '')
               {
                  $this->db->group_start();

                  $this->db->like('project_code',$search);
                  $this->db->or_like('project_name',$search);
                  $this->db->or_like('project_status',$search);
                  $this->db->or_like('description',$search);

                  $this->db->group_end();
               }

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
                  'total'=>$this->db->count_all('projects')
               ];
            }

            public function get_single_project(){
               $id = $this->uri->segment('2');
               $this->db->where('id',$id);
               $this->db->where('status','1');
               $this->db->where('is_deleted','0');
               return $this->db->get('projects')->row();
            }

            public function get_all_project_list(){
               $this->db->where('status','1');
               $this->db->where('is_deleted','0');
               return $this->db->get('projects')->result();
            }

            public function get_all_users_list(){
               $this->db->where('is_active','1');
               $this->db->where('is_deleted','0');
               return $this->db->get('users')->result();
            }

            public function set_module(){
                //  echo "<pre>";print_r($_POST);exit;
                 $data = [
                        'module_name' => $this->input->post('module_name'),
                        'project_id' => $this->input->post('project_id'),
                        'description' => $this->input->post('description'),
                 ];

                 $id =  $this->input->post('id');
                 if($id != ''){
                    $this->db->where('id',$id);
                    $this->db->update('tbl_modules',$data);
                    return 2; // update
                 }else{
                    $data['created_on'] = date('Y-m-d h:i:s');
                    $this->db->insert('tbl_modules',$data);
                    return 1; // insert
                 }

                 exit;
            }
            public function get_single_module(){
               $id = $this->uri->segment('2');
               $this->db->where('id',$id);
               $this->db->where('status','1');
               $this->db->where('is_deleted','0');
               return $this->db->get('tbl_modules')->row();
            }


             public function get_all_modules()
            {
               $search = $this->input->post('search')['value'];

               $this->db->select('tbl_modules.*, projects.project_code, projects.project_name');
               $this->db->from('tbl_modules');
               $this->db->join('projects','projects.id = tbl_modules.project_id','left');

               if($search != '')
               {
                  $this->db->group_start();

                  $this->db->like('projects.project_code',$search);
                  $this->db->like('projects.project_name',$search);
                  $this->db->or_like('tbl_modules.module_name',$search);
                  $this->db->or_like('tbl_modules.description',$search);

                  $this->db->group_end();
               }

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
                  'total'=>$this->db->count_all('tbl_modules')
               ];
            }

            public function get_all_module_list(){
               $this->db->where('status','1');
               $this->db->where('is_deleted','0');
               return $this->db->get('tbl_modules')->result();
            }

            public function get_all_module_list_by_project_id($project_id){
               $this->db->where('project_id',$project_id);
               $this->db->where('status','1');
               $this->db->where('is_deleted','0');
               return $this->db->get('tbl_modules')->result();
            }

            public function get_all_task_list_by_project_module_id($project_id, $module_id){
               $this->db->where('project_id',$project_id);
               $this->db->where('module_id',$module_id);
               $this->db->where('status','1');
               $this->db->where('is_deleted','0');
               return $this->db->get('tbl_tasks')->result();
            }

            public function get_module_by_project_id(){
               $project_id = $this->input->post('project_id');
               $this->db->where('project_id',$project_id);
               $this->db->where('status','1');
               $this->db->where('is_deleted','0');
               $modules = $this->db->get('tbl_modules')->result();
               // echo "<pre>";print_r($modules);exit;
                echo json_encode($modules);
            }

            public function set_sub_module(){
                //  echo "<pre>";print_r($_POST);exit;
                 $data = [
                        'sub_module_name' => $this->input->post('sub_module_name'),
                        'project_id' => $this->input->post('project_id'),
                        'module_id' => $this->input->post('module_id'),
                        'description' => $this->input->post('description'),
                 ];

                 $id =  $this->input->post('id');
                 if($id != ''){
                    $this->db->where('id',$id);
                    $this->db->update('tbl_sub_modules',$data);
                    return 2; // update
                 }else{
                    $data['created_on'] = date('Y-m-d h:i:s');
                    $this->db->insert('tbl_sub_modules',$data);
                    return 1; // insert
                 }

                 exit;
            }
            public function get_single_sub_module(){
               $id = $this->uri->segment('2');
               $this->db->where('id',$id);
               $this->db->where('status','1');
               $this->db->where('is_deleted','0');
               return $this->db->get('tbl_sub_modules')->row();
            }

            public function get_all_sub_modules()
            {
               $search = $this->input->post('search')['value'];

               $this->db->select('tbl_sub_modules.*, projects.project_code, projects.project_name, tbl_modules.module_name');
               $this->db->from('tbl_sub_modules');
               $this->db->join('projects','projects.id = tbl_sub_modules.project_id','left');
               $this->db->join('tbl_modules','tbl_modules.id = tbl_sub_modules.module_id','left');

               if($search != '')
               {
                  $this->db->group_start();

                  $this->db->like('projects.project_code',$search);
                  $this->db->like('projects.project_name',$search);
                  $this->db->like('tbl_modules.module_name',$search);
                  $this->db->or_like('tbl_sub_modules.sub_module_name',$search);
                  $this->db->or_like('tbl_sub_modules.description',$search);

                  $this->db->group_end();
               }

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
                  'total'=>$this->db->count_all('tbl_sub_modules')
               ];
            }

            public function get_sub_module_by_module_id(){
               $module_id = $this->input->post('module_id');
               $this->db->where('module_id',$module_id);
               $this->db->where('status','1');
               $this->db->where('is_deleted','0');
               $modules = $this->db->get('tbl_sub_modules')->result();
               // echo "<pre>";print_r($modules);exit;
                echo json_encode($modules);
            }
    }


?>