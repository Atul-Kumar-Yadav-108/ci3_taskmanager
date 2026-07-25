<?php $this->load->view('layout/header');?>
<style>
    .modal-body {
    white-space: pre-wrap;
    word-break: break-word;
    overflow-wrap: break-word;
}
</style>
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">
                <i class="fa-solid fa-gauge-high me-2 text-primary"></i>Dashboard
            </h4>
            <p class="text-muted mb-0">
                Welcome, <strong><?= htmlspecialchars($this->session->userdata('user_name')) ?></strong>
            </p>
        </div>
    </div>

    <!-- Stats row (placeholder) -->
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon bg-primary-subtle rounded-3 p-3">
                        <i class="fa-solid fa-list-check fa-lg text-primary"></i>
                    </div>
                    <div>
                        <div class="fs-4 fw-bold"><?= $statistics->total_tasks ?? 0 ?></div>
                        <div class="text-muted small">Total Tasks</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon bg-success-subtle rounded-3 p-3">
                        <i class="fa-solid fa-circle-check fa-lg text-success"></i>
                    </div>
                    <div>
                        <div class="fs-4 fw-bold"><?= $statistics->completed_tasks ?? 0?></div>
                        <div class="text-muted small">Completed</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon bg-warning-subtle rounded-3 p-3">
                        <i class="fa-solid fa-spinner fa-lg text-warning"></i>
                    </div>
                    <div>
                        <div class="fs-4 fw-bold"><?= $statistics->in_progress_tasks ?? 0 ?></div>
                        <div class="text-muted small">In Progress</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon bg-danger-subtle rounded-3 p-3">
                        <i class="fa-solid fa-circle-exclamation fa-lg text-danger"></i>
                    </div>
                    <div>
                        <div class="fs-4 fw-bold"><?= $statistics->overdue_tasks ?? 0 ?></div>
                        <div class="text-muted small">Overdue</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Placeholder for task list -->
<div class="container py-4">



    <!-- Placeholder for task list -->
    <div class="card border-0 shadow-sm p-5">
            <div class="title my-3 mx-5 d-flex justify-content-between">
                <h4>Overdue Tasks</h4>
                 
            </div>
        <div class="table mx-3 table-responsive">
                   <table id="example" class=" display nowrap" width="100%">
            <thead>
                <tr>
                    <th>Sno</th>
                    <th>Priority</th>
                    <th>End Date</th>
                    <th>Start Date</th>
                    <th>Hours</th>
                    <th>Task Title</th>
                    <th>Project Name</th>
                    <th>Module Name</th>
                    <th>Sub Module Name</th>
                    <th>Task Status</th>
                    <th>Status</th>
                    <th class="description">Description</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
        </div>
        <!-- <div class="card-body text-center py-5 text-muted">
            <i class="fa-solid fa-inbox fa-3x mb-3 opacity-25"></i>
            <p class="mb-0">Project list</p>
        </div> -->
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Module Description</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            ...
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
</div>

    <!-- Placeholder for task list -->
<div class="container py-4">



    <!-- Placeholder for task list -->
    <div class="card border-0 shadow-sm p-5">
            <div class="title my-3 mx-5 d-flex justify-content-between">
                <h4>Ongoing Task Tasks</h4>
                 
            </div>
        <div class="table mx-3 table-responsive">
                   <table id="started_example" class=" display nowrap" width="100%">
            <thead>
                <tr>
                    <th>Sno</th>
                    <th>Priority</th>
                    <th>End Date</th>
                    <th>Start Date</th>
                    <th>Hours</th>
                    <th>Task Title</th>
                    <th>Project Name</th>
                    <th>Module Name</th>
                    <th>Sub Module Name</th>
                    <th>Task Status</th>
                    <th>Status</th>
                    <th class="description">Description</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
        </div>
        <!-- <div class="card-body text-center py-5 text-muted">
            <i class="fa-solid fa-inbox fa-3x mb-3 opacity-25"></i>
            <p class="mb-0">Project list</p>
        </div> -->
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Module Description</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            ...
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
</div>

</div>
<?php $this->load->view('layout/footer');?>



<script>
$(document).ready(function () {

    $('#example').DataTable({
		serverSide: true,
        processing: true,
        responsive: false,
        stateSave: true,
        autoWidth: false,
        fixedHeader: true,
        pageLength: 10,
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        ajax: {
            url: "<?= base_url('admin/Ajax_controller/get_overdue_task_list_ajx'); ?>",
            type: "POST",
            // dataSrc: ""
        },
        columns: [
            { data: "sno" },
            { data: "priority" },
            { data: "end_date" },
            { data: "start_date" },
            { data: "hours" },
            { data: "task_title" },
            { data: "project_name" },
            { data: "module_name" },
            { data: "sub_module_name" },
            { data: "task_status" },
            { data: "status" },
            { data: "description",
                    render: function(data, type, row) {
                        return `<button class="btn btn-sm btn-info view-description"
                                data-description="${$('<div>').text(data).html()}">
                                <i class="fa-solid fa-eye"></i> View
                            </button>`;
                    }
            },
            {
                data: "action",
                orderable: false,
                searchable: false
            }
        ],
        columnDefs: [
            {
                targets: 12, // Description column
                className: 'description'
            }
        ],
                buttons: [
            {
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
            },
        ],
        layout: {
            topStart: {
                buttons: [
                    'excel'
                ]
            }
        },
    });
    $('#started_example').DataTable({
		serverSide: true,
        processing: true,
        responsive: false,
        stateSave: true,
        autoWidth: false,
        fixedHeader: true,
        pageLength: 10,
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        ajax: {
            url: "<?= base_url('admin/Ajax_controller/get_started_task_list_ajx'); ?>",
            type: "POST",
            // dataSrc: ""
        },
        columns: [
            { data: "sno" },
            { data: "priority" },
            { data: "end_date" },
            { data: "start_date" },
            { data: "hours" },
            { data: "task_title" },
            { data: "project_name" },
            { data: "module_name" },
            { data: "sub_module_name" },
            { data: "task_status" },
            { data: "status" },
            { data: "description",
                    render: function(data, type, row) {
                        return `<button class="btn btn-sm btn-info view-description"
                                data-description="${$('<div>').text(data).html()}">
                                <i class="fa-solid fa-eye"></i> View
                            </button>`;
                    }
            },
            {
                data: "action",
                orderable: false,
                searchable: false
            }
        ],
        columnDefs: [
            {
                targets: 12, // Description column
                className: 'description'
            }
        ],
                buttons: [
            {
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
            },
        ],
        layout: {
            topStart: {
                buttons: [
                    'excel'
                ]
            }
        },
    });

});

$(document).on('click', '.view-description', function () {
    var description = $(this).attr('data-description');

    $('#exampleModal .modal-body').html(description);

    var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
    myModal.show();
});
$(document).on('change', '.task-status-dropdown', function () {
    var task_id = $(this).data('task-id');
    var new_status = $(this).val();
// console.log(new_status);

    $.ajax({
        url: "<?= base_url('admin/Ajax_controller/update_task_status'); ?>",
        type: "POST",
        data: {
            task_id: task_id,
            status: new_status
        },
        success: function (response) {
            // Handle success response
            response = JSON.parse(response);
            if (response.success) {
                alert(response.message);
                window.location.reload(); // Reload the page to reflect the updated status
            } else {
                alert(response.message);
                window.location.reload(); // Reload the page to reflect the updated statuss
            }
        }
    });
});
</script>