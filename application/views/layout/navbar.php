
<!-- ===== NAVBAR (hidden on login/register pages) ===== -->
<?php if ($this->session->userdata('logged_in')): ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="<?= base_url('dashboard') ?>">
            <i class="fa-solid fa-list-check me-2"></i>TaskManager
        </a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= (uri_string() === 'dashboard') ? 'active' : '' ?>"
                       href="<?= base_url('dashboard') ?>">
                        <i class="fa-solid fa-gauge-high me-1"></i>Dashboard
                    </a>
                </li>
            </ul>

            <?php
                $current = $this->uri->segment(1);
                $taskActive = in_array($current, ['task_list', 'add_task']);
                $projectActive = in_array($current, ['project_list', 'add_project','module_list', 'add_module','sub_module_list', 'add_sub_module']);
                // $moduleActive = in_array($current, ['module_list', 'add_module']);
                // $subModuleActive = in_array($current, ['sub_module_list', 'add_sub_module']);
            ?>
            <div class="ceteral-nav d-flex flex-column flex-lg-row gap-2">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 <?= $taskActive ? 'active' : '' ?>" href="#" id="taskDropdown"  role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-list-check"></i>
                        <span>Task</span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="taskDropdown">
                        <li>
                            <a class="dropdown-item <?= $current == 'task_list' ? 'active' : '' ?>"
                            href="<?= base_url('task_list') ?>">
                                <i class="fa-solid fa-list-check me-2"></i>
                                Task List
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item <?= $current == 'add_task' ? 'active' : '' ?>"
                            href="<?= base_url('add_task') ?>">
                                <i class="fa-solid fa-circle-plus me-2"></i>
                                Add Task
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            
           <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 <?= $projectActive ? 'active' : '' ?>"
                    href="#"
                    id="projectDropdown"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">

                        <i class="fa-solid fa-diagram-project"></i>
                        <span>Project</span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="projectDropdown">

                        <!-- Projects -->
                        <li>
                            <h6 class="dropdown-header">
                                <i class="fa-solid fa-folder me-2"></i>Projects
                            </h6>
                        </li>

                        <li>
                            <a class="dropdown-item <?= $current == 'project_list' ? 'active' : '' ?>"
                            href="<?= base_url('project_list') ?>">
                                <i class="fa-solid fa-folder-open me-2"></i>
                                Project List
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item <?= $current == 'add_project' ? 'active' : '' ?>"
                            href="<?= base_url('add_project') ?>">
                                <i class="fa-solid fa-folder-plus me-2"></i>
                                Add Project
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <!-- Modules -->
                        <li>
                            <h6 class="dropdown-header">
                                <i class="fa-solid fa-cubes me-2"></i>Modules
                            </h6>
                        </li>

                        <li>
                            <a class="dropdown-item <?= $current == 'module_list' ? 'active' : '' ?>"
                            href="<?= base_url('module_list') ?>">
                                <i class="fa-solid fa-table-list me-2"></i>
                                Module List
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item <?= $current == 'add_module' ? 'active' : '' ?>"
                            href="<?= base_url('add_module') ?>">
                                <i class="fa-solid fa-cube me-2"></i>
                                Add Module
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <!-- Sub Modules -->
                        <li>
                            <h6 class="dropdown-header">
                                <i class="fa-solid fa-cubes-stacked me-2"></i>Sub Modules
                            </h6>
                        </li>

                        <li>
                            <a class="dropdown-item <?= $current == 'sub_module_list' ? 'active' : '' ?>"
                            href="<?= base_url('sub_module_list') ?>">
                                <i class="fa-solid fa-list-ul me-2"></i>
                                Sub Module List
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item <?= $current == 'add_sub_module' ? 'active' : '' ?>"
                            href="<?= base_url('add_sub_module') ?>">
                                <i class="fa-solid fa-square-plus me-2"></i>
                                Add Sub Module
                            </a>
                        </li>
                        <!-- ================================================= -->
                        <!-- Milestones (Future Feature) -->
                        <!-- ================================================= -->
                      

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <h6 class="dropdown-header">
                                <i class="fa-solid fa-flag-checkered me-2"></i>Milestones
                            </h6>
                        </li>

                        <li>
                            <a class="dropdown-item <?= $current == 'milestone_list' ? 'active' : '' ?>"
                            href="<?= base_url('milestone_list') ?>">
                                <i class="fa-solid fa-list-check me-2"></i>
                                Milestone List
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item <?= $current == 'add_milestone' ? 'active' : '' ?>"
                            href="<?= base_url('add_milestone') ?>">
                                <i class="fa-solid fa-flag me-2"></i>
                                Add Milestone
                            </a>
                        </li>


                        <!-- ================================================= -->
                        <!-- Issues (Future Feature) -->
                        <!-- ================================================= -->
              

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <h6 class="dropdown-header">
                                <i class="fa-solid fa-bug me-2"></i>Issues
                            </h6>
                        </li>

                        <li>
                            <a class="dropdown-item <?= $current == 'issue_list' ? 'active' : '' ?>"
                            href="<?= base_url('issue_list') ?>">
                                <i class="fa-solid fa-list-ul me-2"></i>
                                Issue List
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item <?= $current == 'add_issue' ? 'active' : '' ?>"
                            href="<?= base_url('add_issue') ?>">
                                <i class="fa-solid fa-circle-exclamation me-2"></i>
                                Add Issue
                            </a>
                        </li>

                      
                </li>
            </ul>
            </div>

            <!-- User dropdown -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                       href="#" id="userDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="avatar-circle">
                            <?= strtoupper(substr($this->session->userdata('user_name'), 0, 1)) ?>
                        </span>
                        <span><?= htmlspecialchars($this->session->userdata('user_name')) ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item text-danger" href="<?= base_url('logout') ?>">
                                <i class="fa-solid fa-right-from-bracket me-2"></i>Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php endif; ?>