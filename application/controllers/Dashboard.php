<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Dashboard Controller
 * Protected – requires login.
 */
class Dashboard extends Authenticated_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title']      = 'Add Task';
        $data['page_class'] = 'page-task';
        $statistics = $this->Task_model->get_statistics();
        $data['statistics'] = $statistics;
        // echo "<pre>";
        // print_r($data);
        // exit;
        $this->render('dashboard/index', $data);
    }
}
