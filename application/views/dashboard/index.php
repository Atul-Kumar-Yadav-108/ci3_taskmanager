<?php $this->load->view('layout/header');?>
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
                        <div class="fs-4 fw-bold">0</div>
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
                        <div class="fs-4 fw-bold">0</div>
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
                        <div class="fs-4 fw-bold">0</div>
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
                        <div class="fs-4 fw-bold">0</div>
                        <div class="text-muted small">Overdue</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Placeholder for task list -->
    <div class="card border-0 shadow-sm">
        <div class="card-body text-center py-5 text-muted">
            <i class="fa-solid fa-inbox fa-3x mb-3 opacity-25"></i>
            <p class="mb-0">No tasks yet. Start by creating your first task.</p>
        </div>
    </div>

</div>
<?php $this->load->view('layout/footer');?>