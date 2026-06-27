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
        $this->render('dashboard/index', $data);
    }
}
