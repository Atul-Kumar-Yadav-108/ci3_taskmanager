<?php $this->load->view('layout/header');?>
<div class="container py-4">

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white">
            <h5 class="mb-0">
                <i class="fa-solid fa-folder-plus me-2"></i>
                <?php echo !empty($single) ? 'Update Project' : 'Add Project'; ?>
            </h5>
        </div>

        <div class="card-body">

            <form method="post" id="add_project">
                <input type="hidden" name="id" id="id" value="<?php echo !empty($single) ? $single->id : ''; ?>">
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Project Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="project_name" placeholder="Enter project name" value="<?php echo !empty($single) ? $single->project_name : ''; ?>">
                    </div>


                    <div class="col-md-6 mb-3">
                        <label class="form-label">Project Code <span class="text-danger">*</span></label>
                        <input type="text" class="form-control <?php echo !empty($single) ? "readOnly" : ''; ?>" name="project_code" placeholder="Enter project code" value="<?php echo !empty($single) ? $single->project_code : ''; ?>" <?php echo !empty($single) ? "readonly" : ''; ?>>
                    </div>


                    <div class="col-md-6 mb-3">
                        <label class="form-label">Start Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control datepicker" name="start_date"  placeholder="Select start date" value="<?php echo !empty($single) ? $single->start_date : ''; ?>">
                    </div>


                    <div class="col-md-6 mb-3">
                        <label class="form-label">End Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control datepicker" name="end_date"  placeholder="Select end date" value="<?php echo !empty($single) ? $single->end_date : ''; ?>">
                    </div>


                    <div class="col-md-6 mb-3">
                        <label class="form-label">Project Status <span class="text-danger">*</span></label>

                        <select class="form-select" name="project_status" >

                            <option value="">Select Status</option>
                            <option value="Pending" <?php echo !empty($single) && $single->project_status == 'Pending' ? "selected" : ''; ?>>Pending</option>
                            <option value="Running" <?php echo !empty($single) && $single->project_status == 'Running' ? "selected" : ''; ?>>Running</option>
                            <option value="Completed" <?php echo !empty($single) && $single->project_status == 'Completed' ? "selected" : ''; ?>>Completed</option>
                            <option value="Hold" <?php echo !empty($single) && $single->project_status == 'Hold' ? "selected" : ''; ?>>Hold</option>

                        </select>

                    </div>


                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description <span class="text-danger">*</span></label>

                        <textarea class="form-control" name="description" rows="4" placeholder="Enter project description"><?php echo !empty($single) ? $single->description : ''; ?></textarea>

                    </div>


                </div>


                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-save me-2"></i>
                    Save Project
                </button>


                <a href="<?= base_url('project_list') ?>" class="btn btn-light ms-2">
                    Cancel
                </a>


            </form>

        </div>

    </div>

</div>
<?php $this->load->view('layout/footer');?>


<script>
$(document).ready(function () {

    $("#add_project").validate({
        ignore : [],
        rules: {
            project_name:   { required: true },
            project_code:   { required: true },
            project_status: { required: true },
            start_date:     { required: true },
            end_date:       { required: true },
            description:       { required: true }
        },
        messages: {
            project_name:   { required: "Please enter project name" },
            project_code:   { required: "Please enter project code" },
            project_status: { required: "Please select project status" },
            start_date:     { required: "Please select start date" },
            end_date:       { required: "Please select end date" },
            description:       { required: "Please enter description" }
        },
        errorElement: "span",
        errorClass: "text-danger small d-block mt-1",
       errorPlacement: function(error, element) {
        // Agar element Bootstrap ka custom select hai ya input-group ke andar wrap hai
        if (element.hasClass('form-select') || element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } 
        // Agar datepicker container ya koi aur component field ko wrap kar raha ho
        else if (element.hasClass('datepicker') && element.parent().length) {
            // Yeh ensure karega ki date field ke main wrapper container ke exact baad message aaye
            error.insertAfter(element);
        } 
        // Standard inputs ke liye default fallback
        else {
            error.insertAfter(element);
        }
    },
        submitHandler: function (form) {
            form.submit();
        }
    });

});
</script>
