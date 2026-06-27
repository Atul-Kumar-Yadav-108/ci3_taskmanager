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

        $this->render('projects/add_project', $data);
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

        $this->render('projects/add_module', $data);
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

        $this->render('projects/add_sub_module', $data);
    }


    // Milestone List (Future)
    public function milestone_list()
    {
        $data['title']      = 'Milestone List';
        $data['page_class'] = 'page-milestone';

        $this->render('projects/milestone_list', $data);
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