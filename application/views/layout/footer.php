<!-- ===== MAIN CONTENT END ===== -->

<!-- task history modal -->
    <div class="modal fade" id="taskHistoryModal" tabindex="-1" aria-labelledby="taskHistoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskHistoryModalLabel">History Description</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

<footer class="footer mt-auto py-3 bg-light border-top">
    <div class="container text-center text-muted small">
        &copy; <?= date('Y') ?> TaskManager. All rights reserved.
    </div>
</footer>

<!-- jQuery -->
<script src="<?= base_url('assets/vendor/jquery/jquery-3.7.1.min.js') ?>"></script>
<!-- Bootstrap 5 Bundle (includes Popper) -->
<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- jQuery Validate -->
<script src="<?= base_url('assets/vendor/jquery/validatejquery/dist/jquery.validate.min.js') ?>"></script>
<!-- Flatpickr -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  
<script src="https://cdn.datatables.net/2.3.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.3/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.html5.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<!-- <script src="https://kit.fontawesome.com/YOUR_KIT_CODE.js" crossorigin="anonymous"></script> -->

<script src="<?= base_url('assets/js/datepicker.js') ?>"></script>
<!-- Custom JS -->
<script src="<?= base_url('assets/js/script.js') ?>"></script>

<!-- <?php if (!empty($page_scripts)) echo $page_scripts; ?> -->

<script>
$(document).on('click', '.view-task-history', function () {
    var task_id = $(this).attr('data-id');
    
    if (task_id != '') {
        $.ajax({
            url: "<?= base_url('admin/Ajax_controller/get_task_history_ajx'); ?>",
            type: "POST",
            data: { "task_id": task_id },
            success: function(response) {
                $('#taskHistoryModal .modal-body').html(response);
                var myModal = new bootstrap.Modal(document.getElementById('taskHistoryModal'));
                myModal.show();
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: " + error);
            }
        });
    }
});
</script>

</body>
</html>
