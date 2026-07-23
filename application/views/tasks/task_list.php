<?php $this->load->view('layout/header');?>
<style>
    .modal-body {
    white-space: pre-wrap;
    word-break: break-word;
    overflow-wrap: break-word;
}
</style>
<div class="container py-4">



    <!-- Placeholder for task list -->
    <div class="card border-0 shadow-sm">
            <div class="title my-3 mx-5 d-flex justify-content-between">
                <h4><?= $title ?></h4>
                <a class="btn btn-primary" href="<?= base_url('add_task');?>">Add new task</a>
            </div>
        <div class="table mx-3">
                   <table id="example" class="display">
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
            url: "<?= base_url('admin/Ajax_controller/get_task_list_ajx'); ?>",
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
</script>

