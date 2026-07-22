<?php $this->load->view('layout/header');?>
<div class="container py-4">

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white">
            <h5 class="mb-0">
                <i class="fa-solid fa-folder-plus me-2"></i>
                <?php echo !empty($single) ? 'Update Module' : 'Add Module'; ?>
            </h5>
        </div>

        <div class="card-body">

            <form method="post" id="add_module">
                <input type="hidden" name="id" id="id" value="<?php echo !empty($single) ? $single->id : ''; ?>">
                <div class="row">
                    
                     <div class="col-md-6 mb-3">
                        <label class="form-label">Project <span class="text-danger">*</span></label>

                        <select class="form-select" name="project_id" id="project_id">

                            <option value="">Select Project</option>
                            <?php if(!empty($projects)){ 
                                    foreach($projects as $project){
                                ?>
                                <option value="<?= $project->id?>" <?= (!empty($single) && ($project->id == $single->id)) ? 'selected' : '';?>><?= $project->project_code?> - <?= $project->project_name?></option>
                            <?php }} ?>
                            
                        </select>

                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Module Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="module_name" placeholder="Enter module name" value="<?php echo !empty($single) ? $single->module_name : ''; ?>">
                    </div>


                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description <span class="text-danger">*</span></label>

                        <textarea class="form-control" name="description" rows="4" placeholder="Enter project description"><?php echo !empty($single) ? $single->description : ''; ?></textarea>

                    </div>


                </div>


                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-save me-2"></i>
                    Save Module
                </button>


                <a href="<?= base_url('module_list') ?>" class="btn btn-light ms-2">
                    Cancel
                </a>


            </form>

        </div>

    </div>

</div>
<?php $this->load->view('layout/footer');?>


<script>
$(document).ready(function () {

    $("#add_module").validate({
        ignore : [],
        rules: {
            module_name:   { required: true },
            project_id: { required: true },
            description:       { required: true }
        },
        messages: {
            module_name:   { required: "Please enter module name" },
            project_id: { required: "Please select project" },
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
