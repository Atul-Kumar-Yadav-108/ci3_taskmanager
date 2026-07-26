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
                <i class="fa-solid fa-gauge-high me-2 text-primary"></i>Update Password 
            </h4>
            <p class="text-muted mb-0">
                Update Password, <strong><?= htmlspecialchars($this->session->userdata('user_name')) ?></strong>
            </p>
        </div>
    </div>
    <!-- // User Profile Card -->
    <div class="card border-0 shadow-sm p-5">
<form action="" method="post" enctype="multipart/form-data" class="col-md-12" id="updatePasswordForm">

    <div class="row">
        <div class="col-md-8">
                <div class="col-md-12">
                    <!-- <input type="hidden" name="old_password" id="old_password"> -->
                    <div class="form col-12">
                        <label for="name" class="form-label">Old Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Enter your old password" required>
                            <button class="btn btn-light border error-placement" type="button" id="togglePassword_old" aria-label="Toggle password visibility">
                                    <i class="fa-solid fa-eye text-muted" id="eyeIcon_old"></i>
                            </button>
                        </div>
                    </div>
                    <div class="form col-12">
                        <label for="name" class="form-label">New Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="new_password" id="new_password" placeholder="Enter your new password" required>
                            <button class="btn btn-light border error-placement" type="button" id="togglePassword_new" aria-label="Toggle password visibility">
                                    <i class="fa-solid fa-eye text-muted" id="eyeIcon_new"></i>
                            </button>
                        </div>
                    </div>
                    <div class="form col-12">
                        <label for="name" class="form-label">Confirm New Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="confirm_new_password" id="confirm_new_password" placeholder="Confirm your new password" required>
                            <button class="btn btn-light border error-placement" type="button" id="togglePassword_confirm" aria-label="Toggle password visibility">
                                    <i class="fa-solid fa-eye text-muted" id="eyeIcon_confirm"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-4">
                    <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary">Back to Dashboard</a>
                    <button type="submit" class="btn btn-primary">Update Password</button>
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

$.validator.addMethod("notEqualTo", function(value, element, param) {
    return this.optional(element) || value !== $(param).val();
}, "New password must be different from old password.");

$("#updatePasswordForm").validate({
    rules: {
        old_password: {
            required: true,
            minlength: 2
        },
        new_password: {
            required: true,
            minlength: 6,
            notEqualTo: "#old_password"
        },
        confirm_new_password: {
            required: true,
            equalTo: "#new_password"
        }
    },
    messages: {
        old_password: {
            required: "Please enter your old password",
            minlength: "Your old password must consist of at least 2 characters"
        },
        new_password: {
            required: "Please enter your new password",
            minlength: "Your new password must consist of at least 6 characters"
        },
        confirm_new_password: {
            required: "Please confirm your new password",
            equalTo: "New password and confirm password do not match"
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
    // Toggle password visibility
    document.getElementById('togglePassword_old').addEventListener('click', function () {
        const pwInput = document.getElementById('old_password');
        const eyeIcon = document.getElementById('eyeIcon_old');
        if (pwInput.type === 'password') {
            pwInput.type = 'text';
            eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            pwInput.type = 'password';
            eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    });
    
    // Toggle password visibility
    document.getElementById('togglePassword_new').addEventListener('click', function () {
        const pwInput = document.getElementById('new_password');
        const eyeIcon = document.getElementById('eyeIcon_new');
        if (pwInput.type === 'password') {
            pwInput.type = 'text';
            eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            pwInput.type = 'password';
            eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    });
    
    // Toggle password visibility
    document.getElementById('togglePassword_confirm').addEventListener('click', function () {
        const pwInput = document.getElementById('confirm_new_password');
        const eyeIcon = document.getElementById('eyeIcon_confirm');
        if (pwInput.type === 'password') {
            pwInput.type = 'text';
            eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            pwInput.type = 'password';
            eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    });

    $("#old_password").on('blur', function() {
        var oldPassword = $(this).val();
        if (oldPassword.length > 0) {
            $.ajax({
                url: "<?= base_url('dashboard/verify_old_password'); ?>",
                type: "POST",
                data: { old_password: oldPassword },
                success: function(response) {
                    console.log('ahgsdgfag fla', response);
                    // response = JSON.parse(response);
                    if (!response.valid) {
                        // alert(response.message);
                        // $("#old_password").val('').focus();
                        $(".error-placement").next('.invalid-feedback').remove();
                        $("#old_password").addClass('is-invalid');
                        $(".error-placement").after('<div class="invalid-feedback">Current password is incorrect.</div>');
                    }else{
                        $("#old_password").removeClass('is-invalid');
                        $(".error-placement").next('.invalid-feedback').remove();
                    }
                }
            });
        }
    });
</script>
