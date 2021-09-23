<?= $this->extend('auth/layout/auth_default'); ?>

<?= $this->section('content') ?>

<div id="auth-left">
    <div class="auth-logo">
    <a href="index.html"><img src="<?= site_url() ?>dash_assets/assets/images/logo/logo.png" alt="Logo"></a>
    </div>
    <h1 class="auth-title">Forgot Password</h1>
    <span>We will send you a link to reset your password.</span>
    <div class="text-center">
      <!-- flash messages -->
      <?= view('flashMessages') ?>
      <!-- flash messages end -->
    </div>
    <form class="form-horizontal" action="<?= base_url('auth/forgot') ?>" method="post">
        <fieldset class="form-group position-relative has-icon-left">
            <input type="email" class="form-control form-control-lg input-lg" name="email"
                id="user-email" placeholder="Your Email Address" required>
            <div class="form-control-position">
                <i class="icon-mail6"></i>
            </div>
        </fieldset>
        <button type="submit" class="btn btn-primary btn-lg btn-block"><i
                class="icon-lock4"></i> Recover Password</button>
    </form>
    <div class="text-center mt-5 text-lg fs-4">
    <p class="float-sm-left text-xs-center"><a href="<?= base_url('login') ?>">Login</a></p>
                  <p class="float-sm-right text-xs-center">Don't have an account? <a
                          href="<?= site_url() ?>register" class="card-link">Sign Up</a></p>
    </div>
</div>


  <?= $this->endSection() ?>