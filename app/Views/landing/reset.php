<?= $this->extend('landing/layout/auth_default') ?>

<?= $this->section('content') ?>


<section class="flexbox-container">
      <div class="col-md-4 offset-md-4 col-xs-10 offset-xs-1 box-shadow-2 p-0">
          <div class="card border-grey border-lighten-3 px-2 py-2 m-0">
              <div class="card-header no-border pb-0">
                  <div class="card-title text-xs-center">
                      <a href="<?= site_url() ?>"><img src="<?= site_url() ?>public/logo3.png" width="200px" alt="logo"></a>
                  </div>
                  <h6 class="card-subtitle line-on-side text-muted text-xs-center font-small-3 pt-2">
                      <span>Reset password.</span>
                      <div class="text-center">
                        <!-- flash messages -->
        								<?= view('flashMessages') ?>
        								<!-- flash messages end -->
                      </div>
                  </h6>
              </div>
              <div class="card-body collapse in">
                  <div class="card-block">
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
                  </div>
              </div>
              <div class="card-footer no-border">
                  <p class="float-sm-left text-xs-center"><a href="<?= base_url('login') ?>">Login</a></p>
                  <p class="float-sm-right text-xs-center">Don't have an account? <a
                          href="<?= site_url() ?>register" class="card-link">Sign Up</a></p>
              </div>
          </div>
      </div>
  </section>


<?= $this->endSection() ?>
