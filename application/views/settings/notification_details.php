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
            </div>
        <div class="table mx-3">
                <p><strong>Action Description:</strong> <?= $notification->descriptions ?></p>
                <p><strong>Task Title:</strong> <?= $notification->task_title ?></p>
                <p><strong>Task Description:</strong> <?= $notification->description ?></p>
                <p><strong>Changes By :</strong> <?= $notification->user_name ?></p>
                <p><strong>Email:</strong> <?= $notification->user_email ?></p>
                <p><strong>Action Date & Time:</strong> <?= $notification->created_on ?></p>
        </div>
    </div>
</div>

<?php $this->load->view('layout/footer');?>
