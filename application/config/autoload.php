<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();

// Auto-load core libraries
$autoload['libraries'] = array('database', 'session','form_validation');

$autoload['drivers'] = array();

// Auto-load helpers
$autoload['helper'] = array('url', 'form', 'html');

$autoload['config'] = array();

$autoload['language'] = array();

$autoload['model'] = array('Project_model','Task_model');
