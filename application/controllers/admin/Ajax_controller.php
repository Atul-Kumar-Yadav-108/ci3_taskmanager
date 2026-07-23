<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_controller extends Authenticated_Controller
{
    public function get_project_list_ajx()
    {
        $projects = $this->Project_model->get_all_projects();

        $result = [];
        $i = $this->input->post('start') + 1;

        foreach($projects['data'] as $row)
        {
            $result[]=[
                'sno'=>$i++,
                'end_date'=>$row->end_date,
                'start_date'=>$row->start_date,
                'created_date'=>date('Y-m-d',strtotime($row->created_on)),
                'project_code'=>$row->project_code,
                'project_name'=>$row->project_name,
                'project_status'=>$row->project_status,
                'status'=>$row->status==1?'Active':'Inactive',
                'description'=>$row->description,
                'action'=>'<a href="'.base_url('add_project/'.$row->id).'" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>'
            ];
        }

        echo json_encode([
            "draw"=>intval($this->input->post('draw')),
            "recordsTotal"=>$projects['total'],
            "recordsFiltered"=>$projects['filtered'],
            "data"=>$result
        ]);
    }


    public function get_module_list_ajx()
    {
        $projects = $this->Project_model->get_all_modules();

        $result = [];
        $i = $this->input->post('start') + 1;

        foreach($projects['data'] as $row)
        {
            $result[]=[
                'sno'=>$i++,
                'project_name'=> $row->project_code . " - " .$row->project_name,
                'module_name'=>$row->module_name,
                'status'=>$row->status==1?'Active':'Inactive',
                'description'=>$row->description,
                'action'=>'<a href="'.base_url('add_module/'.$row->id).'" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>'
            ];
        }

        echo json_encode([
            "draw"=>intval($this->input->post('draw')),
            "recordsTotal"=>$projects['total'],
            "recordsFiltered"=>$projects['filtered'],
            "data"=>$result
        ]);
    }

    public function get_sub_module_list_ajx()
    {
        $projects = $this->Project_model->get_all_sub_modules();

        $result = [];
        $i = $this->input->post('start') + 1;

        foreach($projects['data'] as $row)
        {
            $result[]=[
                'sno'=>$i++,
                'project_name'=> $row->project_code . " - " .$row->project_name,
                'module_name'=>$row->module_name,
                'sub_module_name'=>$row->sub_module_name,
                'status'=>$row->status==1?'Active':'Inactive',
                'description'=>$row->description,
                'action'=>'<a href="'.base_url('add_sub_module/'.$row->id).'" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>'
            ];
        }

        echo json_encode([
            "draw"=>intval($this->input->post('draw')),
            "recordsTotal"=>$projects['total'],
            "recordsFiltered"=>$projects['filtered'],
            "data"=>$result
        ]);
    }

    public function get_module_by_project_id(){
        return $this->Project_model->get_module_by_project_id();
    }
    public function get_sub_module_by_module_id(){
        return $this->Project_model->get_sub_module_by_module_id();
    }


    
    public function get_task_list_ajx()
    {
        $tasks = $this->Task_model->get_all_tasks();
        // echo "<pre>";print_r($tasks);exit;
        $result = [];
        $i = $this->input->post('start') + 1;

        foreach($tasks['data'] as $row)
        {
            $result[]=[
                'sno'=>$i++,
                'priority'=>$row->priority,
                'end_date'=>date('Y-m-d', strtotime($row->end_date)),
                'start_date'=>date('Y-m-d', strtotime($row->start_date)),
                'hours'=>$row->hours,
                'task_title'=>$row->task_title,
                'project_name'=>$row->project_name,
                'module_name'=>$row->module_name,
                'sub_module_name'=>$row->sub_module_name,
                'task_status'=>$row->task_status,
                'status'=>$row->status==1?'Active':'Inactive',
                'description'=>$row->description,
                'action'=>'<a href="'.base_url('add_task/'.$row->id).'" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>'
            ];
        }

        echo json_encode([
            "draw"=>intval($this->input->post('draw')),
            "recordsTotal"=>$tasks['total'],
            "recordsFiltered"=>$tasks['filtered'],
            "data"=>$result
        ]);
    }

}
?>