<?php $this->load->view('layout/header');?>
<div class="container py-4">

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white">
            <h5 class="mb-0">
                <i class="fa-solid fa-folder-plus me-2"></i>
                <?php echo !empty($single) ? 'Update Sub Module' : 'Add Sub Module'; ?>
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
                                <option value="<?= $project->id?>" <?= (!empty($single) && ($project->id == $single->project_id)) ? 'selected' : '';?>><?= $project->project_code?> - <?= $project->project_name?></option>
                            <?php }} ?>
                            
                        </select>

                    </div>
                     <div class="col-md-6 mb-3">
                        <label class="form-label">Module <span class="text-danger">*</span></label>

                        <select class="form-select" name="module_id" id="module_id">

                            <option value="">Select Module</option>
                            <?php if(!empty($modules)){ 
                                    foreach($modules as $module){
                                ?>
                                <option value="<?= $module->id?>" <?= (!empty($single) && ($module->id == $single->module_id)) ? 'selected' : '';?>><?= $module->module_name?></option>
                            <?php }} ?>
                            
                        </select>

                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sub Module Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="sub_module_name" placeholder="Enter module name" value="<?php echo !empty($single) ? $single->sub_module_name : ''; ?>">
                    </div>


                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description <span class="text-danger">*</span></label>

                        <textarea class="form-control" name="description" rows="4" placeholder="Enter project description"><?php echo !empty($single) ? $single->description : ''; ?></textarea>

                    </div>


                </div>


                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-save me-2"></i>
                    Save Sub Module
                </button>


                <a href="<?= base_url('sub_module_list') ?>" class="btn btn-light ms-2">
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
            sub_module_name:   { required: true },
            project_id: { required: true },
            module_id: { required: true },
            description:       { required: true }
        },
        messages: {
            sub_module_name:   { required: "Please enter sub module name" },
            project_id: { required: "Please select project" },
            module_id: { required: "Please select module" },
            description:       { required: "Please enter description" }
        },
        errorElement: "span",
        errorClass: "text-danger small d-block mt-1",
       errorPlacement: function(error, element) {
        // Agar element Bootstrap ka custom select hai ya input-group ke andar wrap hai
        if (element.hasClass('form-select') || element.parent('.input-group').length) {
            error.insertAfter(element);
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
$(document).on("change","#project_id",function(){
    var project_id = $(this).val();
    $.ajax({
        url: "<?php echo base_url('admin/Ajax_controller/get_module_by_project_id')?>",
        type: "POST",
        data: {
            project_id: project_id
        },
        success: function(response) {
            $("#module_id").html("");
                    
            $("#module_id").append('<option value="">Select Module</option>');
            response = JSON.parse(response);
            $.each(response, function(index, module) {
                $("#module_id").append(
                    '<option value="' + module.id + '">' + module.module_name + '</option>'
                );
            });
        }
    });
});

</script>
