<?= $this->extend('auth/layout/auth_default'); ?>

<?= $this->section('content') ?>

                <div id="auth-left">
                    <div class="auth-logo">
                    <a href="<?= site_url() ?>"><img src="<?= site_url() ?>dash_assets/assets/images/logo/logo.png" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Sign Up</h1>
                    <!-- flash messages -->
                    <div class="text-center">
                        <?= view('flashMessages') ?>
                    </div>
                    <!-- flash messages end -->

                    <form class="form-horizontal form-simple" action="<?= base_url('auth/register/'.$params) ?>" method="post" enctype="multipart/form-data">
                    <fieldset class="form-group position-relative has-icon-left mb-1">
                      <input type="text" class="form-control form-control-lg input-lg" name="firstname" value="<?= set_value('firstname') ?>"
                        placeholder="First Name">
                      <div class="form-control-position">
                        <i class="icon-head"></i>
                      </div>
                    </fieldset>
					<fieldset class="form-group position-relative has-icon-left mb-1">
                      <input type="text" class="form-control form-control-lg input-lg" name="lastname" value="<?= set_value('lastname') ?>"
                        placeholder="Last Name">
                      <div class="form-control-position">
                        <i class="icon-head"></i>
                      </div>
                    </fieldset>
					<fieldset class="form-group position-relative has-icon-left mb-1">

						<select class="form-control form-control-lg input-lg" name="country" required>
						<option value="" selected disabled> --select country--</option>
							<?php foreach($countries as $row): ?>
							<option value="<?= $row->country ?>" <?php echo set_select('country', $row->country); ?>>
								<?= $row->country ?>
							</option>
							<?php endforeach ?>
						</select>

                      <div class="form-control-position">
                        <!-- <i class="icon-head"></i> -->
                      </div>
                    </fieldset>
                    <fieldset class="form-group position-relative has-icon-left mb-1">
                      <input type="email" class="form-control form-control-lg input-lg" name="email" value="<?= set_value('email') ?>"
                        placeholder="Your Email Address" required>
                      <div class="form-control-position">
                        <i class="icon-mail6"></i>
                      </div>
                    </fieldset>


                    <fieldset class="form-group position-relative has-icon-left mb-1">
                      <input type="text" class="form-control form-control-lg input-lg" name="phone" value="<?= set_value('phone') ?>"
                        placeholder="Your Phone Number" required>
                      <div class="form-control-position">
                        <i class="icon-android-phone-portrait"></i>
                      </div>
                    </fieldset>
                    <!-- <fieldset class="form-group position-relative has-icon-left mb-1">
                      <input type="text" class="form-control form-control-lg input-lg" name="btc_address" value="<?= set_value('btc_address') ?>"
                        placeholder="Your Btc Address" required>
                      <div class="form-control-position">
                        <i class="icon-btc"></i>
                      </div>
                    </fieldset> -->


                    <fieldset class="form-group position-relative has-icon-left">
                      <input type="password" class="form-control form-control-lg input-lg" name="password"
                        placeholder="Enter Password" required>
                      <div class="form-control-position">
                        <i class="icon-key3"></i>
                      </div>
                    </fieldset>
                    <fieldset class="form-group position-relative has-icon-left">
                      <div class="mb-3">
                          <label for="formFile" class="form-label">Upload Valid ID</label>
                          <input class="form-control" name="depositShot" type="file" id="formFile">
                      </div>
                    </fieldset>

                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="icon-unlock2"></i>
                      Register</button>
                  </form>
                    <div class="text-center mt-5 text-lg fs-4">
                    <p class="text-xs-center">Already have an account ? <a href="<?= site_url() ?>login"
                    class="card-link">Login</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right" style="background:url(<?= site_url(); ?>assets/images/slider/img-01.jpg) no-repeat scroll 0 0;">

                </div>



<?= $this->endSection() ?>
