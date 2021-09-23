<?= $this->extend('auth/layout/auth_default'); ?>

<?= $this->section('content') ?>


<div id="auth-left">
            <div class="auth-logo">
                <a href="<?= site_url() ?>"><img src="<?= site_url() ?>dash_assets/assets/images/logo/logo.png" alt="Logo"></a>
            </div>
            <h1 class="auth-title">Log in.</h1>
            <!-- flash messages -->
            <div class="text-center">
                <?= view('flashMessages') ?>
            </div>
            <!-- flash messages end -->

            <form class="form-horizontal form-simple" action="<?= base_url('auth/login') ?>" method="post">
                <fieldset class="form-group position-relative has-icon-left mb-0">
                    <input type="email" class="form-control form-control-lg input-lg"
                        name="email" placeholder="Your Email" required>
                    <div class="form-control-position">
                        <i class="icon-head"></i>
                    </div>
                </fieldset>
                <fieldset class="form-group position-relative has-icon-left">
                    <input type="password" class="form-control form-control-lg input-lg"
                        name="password" placeholder="Enter Password" required>
                    <div class="form-control-position">
                        <i class="icon-key3"></i>
                    </div>
                </fieldset>

                <button type="submit" class="btn btn-primary btn-lg btn-block"><i
                        class="icon-unlock2"></i> Login</button>
            </form>
            <div class="text-center mt-5 text-lg fs-4">
                <p class="float-sm-left text-xs-center m-0"><a href="<?= site_url() ?>forgot"
                        class="card-link">Forgot password?</a></p>
                <p class="float-sm-right text-xs-center m-0">Don't have an account? <a
                        href="<?= site_url() ?>register" class="card-link">Sign Up</a></p>
            </div>
    </div>


<?= $this->endSection() ?>
