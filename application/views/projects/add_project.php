<div class="container py-4">

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white">
            <h5 class="mb-0">
                <i class="fa-solid fa-folder-plus me-2"></i>
                Add Project
            </h5>
        </div>

        <div class="card-body">

            <form method="post">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Project Name</label>
                        <input type="text" class="form-control" name="project_name" placeholder="Enter project name">
                    </div>


                    <div class="col-md-6 mb-3">
                        <label class="form-label">Project Code</label>
                        <input type="text" class="form-control" name="project_code" placeholder="Enter project code">
                    </div>


                    <div class="col-md-6 mb-3">
                        <label class="form-label">Start Date</label>
                        <input type="date" class="form-control datepicker" name="start_date"  placeholder="Select start date">
                    </div>


                    <div class="col-md-6 mb-3">
                        <label class="form-label">End Date</label>
                        <input type="date" class="form-control datepicker" name="end_date"  placeholder="Select end date">
                    </div>


                    <div class="col-md-6 mb-3">
                        <label class="form-label">Project Status</label>

                        <select class="form-select" name="project_status">

                            <option value="">Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Running">Running</option>
                            <option value="Completed">Completed</option>
                            <option value="Hold">Hold</option>

                        </select>

                    </div>


                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>

                        <textarea class="form-control" name="description" rows="4" placeholder="Enter project description"></textarea>

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
<script>
$(document).ready(function(){


    $("form").validate({


        rules: {


            project_name: {

                required: true

            },


            project_code: {

                required: true

            },


            project_status: {

                required: true

            },


            start_date: {

                required: true

            },


            end_date: {

                required: true

            }


        },


        messages: {


            project_name: {

                required: "Please enter project name"

            },


            project_code: {

                required: "Please enter project code"

            },


            project_status: {

                required: "Please select project status"

            },


            start_date: {

                required: "Please select start date"

            },


            end_date: {

                required: "Please select end date"

            }


        },


        errorElement: "span",

        errorClass: "text-danger",


        submitHandler: function(form) {

            form.submit();

        }


    });


});
</script>