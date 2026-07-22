<?php $this->load->view('layout/header');?>
<div class="min-vh-100 d-flex align-items-center justify-content-center bg-light">
    <div class="login-card-wrapper w-100" style="max-width: 420px; padding: 1rem;">

        <!-- Logo / Branding -->
        <div class="text-center mb-4">
            <div class="brand-icon mb-3">
                <i class="fa-solid fa-list-check fa-3x text-primary"></i>
            </div>
            <h2 class="fw-bold text-dark mb-1">TaskManager</h2>
            <p class="text-muted small">Sign in to manage your tasks</p>
        </div>

        <!-- Login Card -->
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-4">

                <h5 class="card-title fw-semibold mb-4">Welcome back</h5>

                <?= form_open('login', ['class' => 'needs-validation', 'novalidate' => '']) ?>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-medium">
                            Email address
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fa-solid fa-envelope text-muted"></i>
                            </span>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   class="form-control border-start-0 <?= form_error('email') ? 'is-invalid' : '' ?>"
                                   placeholder="you@example.com"
                                   value="<?= set_value('email') ?>"
                                   required
                                   autocomplete="email">
                            <?php if (form_error('email')): ?>
                                <div class="invalid-feedback">
                                    <?= form_error('email') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label for="password" class="form-label fw-medium mb-0">Password</label>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fa-solid fa-lock text-muted"></i>
                            </span>
                            <input type="password"
                                   id="password"
                                   name="password"
                                   class="form-control border-start-0 border-end-0 <?= form_error('password') ? 'is-invalid' : '' ?>"
                                   placeholder="••••••••"
                                   required
                                   autocomplete="current-password">
                            <button class="btn btn-light border" type="button" id="togglePassword"
                                    aria-label="Toggle password visibility">
                                <i class="fa-solid fa-eye text-muted" id="eyeIcon"></i>
                            </button>
                            <?php if (form_error('password')): ?>
                                <div class="invalid-feedback">
                                    <?= form_error('password') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg fw-semibold">
                            <i class="fa-solid fa-right-to-bracket me-2"></i>Sign In
                        </button>
                    </div>

                <?= form_close() ?>

            </div>
        </div>

        <p class="text-center text-muted small mt-3">
            &copy; <?= date('Y') ?> TaskManager
        </p>
    </div>
</div>
<?php $this->load->view('layout/footer');?>

<script>
    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function () {
        const pwInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        if (pwInput.type === 'password') {
            pwInput.type = 'text';
            eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            pwInput.type = 'password';
            eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    });
</script>
