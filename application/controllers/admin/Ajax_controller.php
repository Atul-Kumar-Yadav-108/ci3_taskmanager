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
                'project_type'=> '<span class="badge ' . ($row->project_type == 'Major' ? 'bg-success' : 'bg-info') . ' fw-bold">' . $row->project_type . '</span>',
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
                 'history'=>'<button class="btn btn-sm btn-info view-task-history"
                                data-id="'.htmlspecialchars($row->id, ENT_QUOTES, 'UTF-8').'">
                                <i class="fa-solid fa-eye"></i> History
                            </button>',
                'task_status' => (
                    $row->task_status == 'Assign' ? '<span class="badge bg-warning text-dark">Assign</span>' :
                    ($row->task_status == 'Running' ? '<span class="badge bg-primary">Running</span>' :
                    ($row->task_status == 'Completed' ? '<span class="badge bg-success">Completed</span>' :
                    ($row->task_status == 'Start' ? '<span class="badge bg-info">Start</span>' :
                     '<span class="badge bg-danger">Hold</span>')))
                ),
                'action'=>'
                <div class="d-flex align-items-center">
                <select class="form-control form-control-sm task-status-dropdown me-2" data-task-id="'.$row->id.'"  style="min-width:150px; width:150px;" '.($row->task_status == 'Completed' ? 'disabled' : '').'>
                    <option value="Assign" '.($row->task_status == 'Assign' ? 'selected' : '').'>Assign</option>
                    <option value="Start" '.($row->task_status == 'Start' ? 'selected' : '').'>Start</option>
                    <option value="Running" '.($row->task_status == 'Running' ? 'selected' : '').'>Running</option>
                    <option value="Completed" '.($row->task_status == 'Completed' ? 'selected' : '').'>Completed</option>
                    <option value="Hold" '.($row->task_status == 'Hold' ? 'selected' : '').'>Hold</option>
                </select>
                    '.($this->session->user_role == 'admin'
                        ? '<a href="'.base_url('add_task/'.$row->id).'" class="btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i>
                        </a>'
                        : ''
                    ).'

                </div>'
            ];
        }

        echo json_encode([
            "draw"=>intval($this->input->post('draw')),
            "recordsTotal"=>$tasks['total'],
            "recordsFiltered"=>$tasks['filtered'],
            "data"=>$result
        ]);
    }

    public function get_overdue_task_list_ajx()
    {
        $tasks = $this->Task_model->get_all_overdue_tasks();
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
                'task_status' => (
                    $row->task_status == 'Assign' ? '<span class="badge bg-warning text-dark">Assign</span>' :
                    ($row->task_status == 'Running' ? '<span class="badge bg-primary">Running</span>' :
                    ($row->task_status == 'Completed' ? '<span class="badge bg-success">Completed</span>' :
                    ($row->task_status == 'Start' ? '<span class="badge bg-info">Start</span>' :
                     '<span class="badge bg-danger">Hold</span>')))
                ),
                'status'=>$row->status==1?'Active':'Inactive',
                'description'=>$row->description,
                'action'=>'
                <div class="d-flex align-items-center">
                <select id="task_status" class="form-control form-control-sm task-status-dropdown me-2" data-task-id="'.$row->id.'"  style="min-width:150px; width:150px;" '.($row->task_status == 'Completed' ? 'disabled' : '').'>
                    <option value="Assign" '.($row->task_status == 'Assign' ? 'selected' : '').'>Assign</option>
                    <option value="Start" '.($row->task_status == 'Start' ? 'selected' : '').'>Start</option>
                    <option value="Running" '.($row->task_status == 'Running' ? 'selected' : '').'>Running</option>
                    <option value="Completed" '.($row->task_status == 'Completed' ? 'selected' : '').'>Completed</option>
                    <option value="Hold" '.($row->task_status == 'Hold' ? 'selected' : '').'>Hold</option>
                </select>
                <a href="'.base_url('add_task/'.$row->id).'" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a></div>'
            ];
        }

        echo json_encode([
            "draw"=>intval($this->input->post('draw')),
            "recordsTotal"=>$tasks['total'],
            "recordsFiltered"=>$tasks['filtered'],
            "data"=>$result
        ]);
    }

    public function get_started_task_list_ajx()
    {
        $tasks = $this->Task_model->get_all_started_tasks();
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
                'task_status' => (
                    $row->task_status == 'Assign' ? '<span class="badge bg-warning text-dark">Assign</span>' :
                    ($row->task_status == 'Running' ? '<span class="badge bg-primary">Running</span>' :
                    ($row->task_status == 'Completed' ? '<span class="badge bg-success">Completed</span>' :
                    ($row->task_status == 'Start' ? '<span class="badge bg-info">Start</span>' :
                     '<span class="badge bg-danger">Hold</span>')))
                ),
                'status'=>$row->status==1?'Active':'Inactive',
                'description'=>$row->description,
                'action'=>'
                <div class="d-flex align-items-center">
                <select id="task_status" class="form-control form-control-sm task-status-dropdown me-2" data-task-id="'.$row->id.'"  style="min-width:150px; width:150px;" '.($row->task_status == 'Completed' ? 'disabled' : '').'>
                    <option value="Assign" '.($row->task_status == 'Assign' ? 'selected' : '').'>Assign</option>
                    <option value="Start" '.($row->task_status == 'Start' ? 'selected' : '').'>Start</option>
                    <option value="Running" '.($row->task_status == 'Running' ? 'selected' : '').'>Running</option>
                    <option value="Completed" '.($row->task_status == 'Completed' ? 'selected' : '').'>Completed</option>
                    <option value="Hold" '.($row->task_status == 'Hold' ? 'selected' : '').'>Hold</option>
                </select>
                <a href="'.base_url('add_task/'.$row->id).'" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a></div>'
            ];
        }

        echo json_encode([
            "draw"=>intval($this->input->post('draw')),
            "recordsTotal"=>$tasks['total'],
            "recordsFiltered"=>$tasks['filtered'],
            "data"=>$result
        ]);
    }


    public function update_task_status()
    {
        $task_id = $this->input->post('task_id');
        $new_status = $this->input->post('status');

        if ($this->Task_model->update_task_status($task_id, $new_status)) {
            echo json_encode(['success' => true, 'message' => 'Task status updated successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update task status.']);
        }
    }

    public function get_settings_logs_ajx()
    {
        $logs = $this->Auth_model->get_all_settings_logs();
        // echo "<pre>";print_r($logs);exit;
        $result = [];
        $i = $this->input->post('start') + 1;

        foreach($logs['data'] as $row)
        {
            $result[]=[
                'sno'=>$i++,
                'action_date'=>date('Y-m-d', strtotime($row->action_date)),
                'action_time'=>date('H:i:s', strtotime($row->action_time)),
                'user_id'=>$row->user_id,
                'user_name'=>$row->name,
                'user_email'=>$row->email,
                'action_id'=>$row->action_id,
                'action'=>$row->action
            ];
        }

        echo json_encode([
            "draw"=>intval($this->input->post('draw')),
            "recordsTotal"=>$logs['total'],
            "recordsFiltered"=>$logs['filtered'],
            "data"=>$result
        ]);
    }

    public function get_password_change_logs_ajx()
    {
        $logs = $this->Auth_model->get_all_password_change_logs();
        // echo "<pre>";print_r($logs);exit;
        $result = [];
        $i = $this->input->post('start') + 1;

        foreach($logs['data'] as $row)
        {
            $result[]=[
                'sno'=>$i++,
                'action_date'=>date('Y-m-d', strtotime($row->action_date)),
                'action_time'=>date('H:i:s', strtotime($row->action_time)),
                'user_id'=>$row->user_id,
                'user_name'=>$row->name,
                'user_email'=>$row->email,
                'action_id'=>$row->action_id,
                'action'=>$row->action
            ];
        }

        echo json_encode([
            "draw"=>intval($this->input->post('draw')),
            "recordsTotal"=>$logs['total'],
            "recordsFiltered"=>$logs['filtered'],
            "data"=>$result
        ]);
    }

    public function get_profile_update_logs_ajx()
    {
        $logs = $this->Auth_model->get_all_profile_update_logs();
        // echo "<pre>";print_r($logs);exit;
        $result = [];
        $i = $this->input->post('start') + 1;

        foreach($logs['data'] as $row)
        {
            $result[]=[
                'sno'=>$i++,
                'action_date'=>date('Y-m-d', strtotime($row->action_date)),
                'action_time'=>date('H:i:s', strtotime($row->action_time)),
                'user_id'=>$row->user_id,
                'user_name'=>$row->name,
                'user_email'=>$row->email,
                'action_id'=>$row->action_id,
                'action'=>$row->action
            ];
        }

        echo json_encode([
            "draw"=>intval($this->input->post('draw')),
            "recordsTotal"=>$logs['total'],
            "recordsFiltered"=>$logs['filtered'],
            "data"=>$result
        ]);
    }

    public function get_task_history_ajx()
    {
        // echo "<pre>";print_r($this->input->post());exit;
        $task_id = $this->input->post('task_id');
        $history = $this->Task_model->get_task_history($task_id);
        // echo print_r($history);exit;

        $html = '<ul class="list-group">';
        if (!empty($history)) {
            foreach ($history as $log) {
                $html .= '<li class="list-group-item">';
                $html .= '<strong>User:</strong> ' . htmlspecialchars($log->name) . '<br>';
                $html .= '<strong>Status:</strong> ' . htmlspecialchars($log->task_status) . '<br>';
                $html .= '<strong>Description:</strong> ' . htmlspecialchars($log->descriptions) . '<br>';
                $html .= '<strong>Date:</strong> ' . date('Y-m-d H:i:s', strtotime($log->created_on));
                $html .= '</li>';
            }
        } else {
            $html .= '<li class="list-group-item">No history available for this task.</li>';
        }       
        if ($history) {
            echo $html;
        } else {
            echo '<p>No history available for this task.</p>';
        }
    }

     public function get_notifications_ajx()
    {
        $logs = $this->Auth_model->get_all_notifications();
        // echo "<pre>";print_r($logs);exit;
        $result = [];
        $i = $this->input->post('start') + 1;

        foreach($logs['data'] as $row)
        {
            $class = $row->is_read == '1' ? 'unread-row' : '';

            $result[] = [
                'sno' => $i++,
                'descriptions' => '<a href="'.base_url('notification_details/'.$row->id).'" class="text-decoration-none '.$class.'">'.$row->descriptions.'</a>'
            ];
        }

        echo json_encode([
            "draw"=>intval($this->input->post('draw')),
            "recordsTotal"=>$logs['total'],
            "recordsFiltered"=>$logs['filtered'],
            "data"=>$result
        ]);
    }

}
?>