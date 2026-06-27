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
        $this->render('tasks/add_task', $data);
    }
}


?>