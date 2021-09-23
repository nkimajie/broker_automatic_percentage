<?= $this->extend('auth/layout/auth_default'); ?>

<?= $this->section('content') ?>

<div id="auth-left">
    <div class="auth-logo">
    <a href="index.html"><img src="<?= site_url() ?>dash_assets/assets/images/logo/logo.png" alt="Logo"></a>
    </div>
    <h1 class="auth-title">Reset Password</h1>
    <div class="text-center">
      <!-- flash messages -->
      <?= view('flashMessages') ?>
      <!-- flash messages end -->
    </div>
    <?= form_open() ?>
    <fieldset class="form-group position-relative has-icon-left">
        <input type="password" class="form-control form-control-lg input-lg" name="password"
        placeholder="Enter Password" required>
        <div class="form-control-position">
        <i class="icon-key3"></i>
        </div>
    </fieldset>
    <fieldset class="form-group position-relative has-icon-left">
        <input type="password" class="form-control form-control-lg input-lg" name="confirm_password"
        placeholder="Confirm Password" required>
        <div class="form-control-position">
        <i class="icon-key3"></i>
        </div>
    </fieldset>
        <button type="submit" class="btn btn-primary btn-lg btn-block"><i
                class="icon-lock4"></i> Change Password</button>
    <?= form_close() ?>
    <div class="text-center mt-5 text-lg fs-4">
    <p class="float-sm-left text-xs-center"><a href="<?= base_url('login') ?>">Login</a></p>
                  <p class="float-sm-right text-xs-center">Don't have an account? <a
                          href="<?= site_url() ?>register" class="card-link">Sign Up</a></p>
    </div>
</div>


  <?= $this->endSection() ?>