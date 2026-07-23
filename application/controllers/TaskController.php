<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TaskController extends Authenticated_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title']      = 'Task List';
        $data['page_class'] = 'page-task';
        $this->render('tasks/task_list', $data);
    }

    public function add_task()
    {
        $data['title']      = 'Add Task';
        $data['page_class'] = 'page-task';
        
        $this->form_validation->set_rules('task_title','Task title','required');
        if($this->form_validation->run() == FALSE){
            $data['single'] = $this->Task_model->get_single_task();
            $data['users'] = $this->Project_model->get_all_users_list();
            $data['projects'] = $this->Project_model->get_all_project_list();
            if(!empty($this->uri->segment(2))){
                $data['modules'] = $this->Project_model->get_all_module_list_by_project_id($data['single']->project_id);
                if(!empty($data['modules'])){
                    $data['sub_modules'] = $this->Project_model->get_all_sub_modules_by_project_module_id($data['single']->project_id, $data['single']->module_id);
                    // print_r($data['sub_modules']);exit;
                        }
            }
            $this->render('tasks/add_task', $data);
        }else{
                $result = $this->Task_model->set_task();
                if($result == 1){
                    $this->session->set_flashdata('success','New task has been created');
                }elseif($result == 2){
                    $this->session->set_flashdata('success','Task has been updated');
                }
                redirect('task_list');      
        }
    }
}


?>