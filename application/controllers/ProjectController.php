<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProjectController extends Authenticated_Controller
{
    public function __construct()
    {
        parent::__construct();
    }


    // Project List
    public function index()
    {
        $data['title']      = 'Project List';
        $data['page_class'] = 'page-project';

        $this->render('projects/project_list', $data);
    }


    // Add Project
    public function add_project()
    {   
        $data['title']      = 'Add Project';
        $data['page_class'] = 'page-add-project';
        $this->form_validation->set_rules('project_name','Project name','required');
        if($this->form_validation->run() ==FALSE)
            {
                // $this->load ->view('form');
                $data['single'] = $this->Project_model->get_single_project();
                $this->render('projects/add_project', $data);
            }
            else
            {
               
                $result = $this->Project_model->set_project();
                if($result == 1){
                    $this->session->set_flashdata('success','New Project has been created');
                }elseif($result == 2){
                    $this->session->set_flashdata('success','Project has been updated');
                }
                redirect('project_list');
            }
    }


    // Module List
    public function module_list()
    {
        $data['title']      = 'Module List';
        $data['page_class'] = 'page-module';

        $this->render('projects/module_list', $data);
    }


    // Add Module
    public function add_module()
    {
        $data['title']      = 'Add Module';
        $data['page_class'] = 'page-add-module';
    $this->form_validation->set_rules('module_name','Module name','required');
        if($this->form_validation->run() == FALSE){
            $data['single'] = $this->Project_model->get_single_module();
            $data['projects'] = $this->Project_model->get_all_project_list();
            // echo "<pre>";print_r($data['projects']);exit;
            $this->render('projects/add_module', $data);
        }else{
            // echo "<pre>";print_r($_POST);exit;
                $result = $this->Project_model->set_module();
                if($result == 1){
                    $this->session->set_flashdata('success','New module has been created');
                }elseif($result == 2){
                    $this->session->set_flashdata('success','Module has been updated');
                }
                redirect('sub_module_list');
        }
        
    }


    // Sub Module List
    public function sub_module_list()
    {
        $data['title']      = 'Sub Module List';
        $data['page_class'] = 'page-sub-module';

        $this->render('projects/sub_module_list', $data);
    }


    // Add Sub Module
    public function add_sub_module()
    {
        $data['title']      = 'Add Sub Module';
        $data['page_class'] = 'page-add-sub-module';
        $this->form_validation->set_rules('sub_module_name','Sub Module name','required');
        if($this->form_validation->run() == FALSE){
            $data['single'] = $this->Project_model->get_single_sub_module();
            $data['projects'] = $this->Project_model->get_all_project_list();
            if(!empty($this->uri->segment(2))){
                $data['modules'] = $this->Project_model->get_all_module_list_by_project_id($data['single']->project_id);
            }
            $this->render('projects/add_sub_module', $data);
        }else{
                $result = $this->Project_model->set_sub_module();
                if($result == 1){
                    $this->session->set_flashdata('success','New sub module has been created');
                }elseif($result == 2){
                    $this->session->set_flashdata('success','Sub module has been updated');
                }
                redirect('sub_module_list');      
        }

    }


    // Milestone List (Future)
    public function milestone_list()
    {
        $data['title']      = 'Milestone List';
        $data['page_class'] = 'page-milestone';
        $this->form_validation->set_rules('module_name','Module name','required');
        if($this->form_validation->run() == FALSE){

            $this->render('projects/milestone_list', $data);
        }else{

        }
    }


    // Add Milestone (Future)
    public function add_milestone()
    {
        $data['title']      = 'Add Milestone';
        $data['page_class'] = 'page-add-milestone';

        $this->render('projects/add_milestone', $data);
    }


    // Issue List (Future)
    public function issue_list()
    {
        $data['title']      = 'Issue List';
        $data['page_class'] = 'page-issue';

        $this->render('projects/issue_list', $data);
    }


    // Add Issue (Future)
    public function add_issue()
    {
        $data['title']      = 'Add Issue';
        $data['page_class'] = 'page-add-issue';

        $this->render('projects/add_issue', $data);
    }

}

?>