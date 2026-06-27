<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Default route → login page
// $route['default_controller'] = 'Auth';
$route['default_controller'] = 'Auth/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Auth routes
$route['login']  = 'Auth/login';
$route['logout'] = 'Auth/logout';

// Dashboard (placeholder for future)
$route['dashboard'] = 'Dashboard/index';
$route['task_list'] = 'TaskController';
$route['add_task'] = 'TaskController/add_task';
$route['project_list'] = 'ProjectController';
$route['add_project'] = 'ProjectController/add_project';
$route['module_list'] = 'ProjectController/module_list';
$route['add_module'] = 'ProjectController/add_module';
$route['sub_module_list'] = 'ProjectController/sub_module_list';
$route['add_sub_module'] = 'ProjectController/add_sub_module';
$route['milestone_list'] = 'ProjectController/milestone_list';
$route['add_milestone'] = 'ProjectController/add_milestone';
$route['issue_list'] = 'ProjectController/issue_list';
$route['add_issue'] = 'ProjectController/add_issue';

