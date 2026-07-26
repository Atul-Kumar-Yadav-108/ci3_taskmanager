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
                <i class="fa-solid fa-gauge-high me-2 text-primary"></i>Profile 
            </h4>
            <p class="text-muted mb-0">
                Welcome, <strong><?= htmlspecialchars($this->session->userdata('user_name')) ?></strong>
            </p>
        </div>
    </div>
    <!-- // User Profile Card -->
    <div class="card border-0 shadow-sm p-5">
<form action="" method="post" enctype="multipart/form-data" class="col-md-12" id="profileForm">

    <div class="row">
        <div class="col-md-4 text-center">

            <?php
            if($user->profile_image){
                $profile_image_url = base_url('uploads/profile_images/' . $user->profile_image);
            } else {
                $profile_image_url = base_url('assets/images/default_profile.jpg');
            }
            ?>

            <img src="<?= $profile_image_url ?>"
                 id="profilePreview"
                 class="img-fluid rounded-circle mb-3"
                 style="width:150px;height:150px;object-fit:cover;">

            <input type="file"
                   name="profile_image"
                   id="profile_image"
                   class="form-control mt-2"
                   accept="image/*">

        </div>

        <div class="col-md-8">
                <div class="col-md-8">
                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($user->id) ?>">
                    <div class="form">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($user->name) ?>">
                    </div>
                    <div class="form">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($user->email) ?>" readonly>
                    </div>
                    <div class="form">
                        <label for="role" class="form-label">Role</label>
                        <input type="text" class="form-control" name="role" value="<?= htmlspecialchars(ucfirst($user->role)) ?>" readonly>
                    </div>
                    <div class="form">
                        <label for="last_login" class="form-label">Last Login</label>
                        <input type="text" class="form-control" name="last_login" value="<?= htmlspecialchars($user->last_login) ?>" readonly>
                    </div>
                    <div class="form">
                        <label for="created_at" class="form-label">Account Created</label>
                        <input type="text" class="form-control" name="created_at" value="<?= htmlspecialchars($user->created_at) ?>" readonly>
                    </div>
                </div>
                <div class="col-md-12 mt-4">
                    <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary">Back to Dashboard</a>
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </div>
            </div>
        </div>
    </form>

</div>
<?php $this->load->view('layout/footer'); ?>



<script>

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

$("#profileForm").validate({
    rules: {
        name: {
            required: true,
            minlength: 2
        },
    },
    messages: {
        name: {
            required: "Please enter your name",
            minlength: "Your name must consist of at least 2 characters"
        }
    },
    errorClass: 'is-invalid',
    // validClass: 'is-valid',
    errorElement: 'div',
    errorPlacement: function(error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form').append(error);
    },
    submitHandler: function(form) {
        form.submit();
    }
});
</script>

<script>
document.getElementById('profile_image').addEventListener('change', function(e){

    const file = e.target.files[0];

    if(file){

        const reader = new FileReader();

        reader.onload = function(event){
            document.getElementById('profilePreview').src = event.target.result;
        }

        reader.readAsDataURL(file);
    }

});
</script>