<?= $this->extend('auth/layout/auth_default') ?>

<?= $this->section('content') ?>


<section class="flexbox-container">
          <div class="col-md-4 offset-md-4 col-xs-10 offset-xs-1 box-shadow-2 p-0">
            <div class="card border-grey border-lighten-3 px-2 py-2 m-0">
              <div class="card-header no-border">
                <div class="card-title text-xs-center">
                  <a href="<?= site_url() ?>"><img src="<?= site_url() ?>public/logo3.png" width="200px" alt="logo"></a>
                </div>
                <h6 class="card-subtitle line-on-side text-muted text-xs-center font-small-3 pt-2"><span>Create
                    Account</span></h6>
				<!-- flash messages -->
				<div class="text-center">
					<?= view('flashMessages') ?>
				</div>
				<!-- flash messages end -->
              </div>
              <div class="card-body collapse in">
                <div class="card-block">
                  <form class="form-horizontal form-simple" action="<?= base_url('auth/register/'.$params) ?>" method="post">
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
							<option value="<?= $row->name ?>" <?php echo set_select('country', $row->name); ?>>
								<?= $row->name ?>
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
                    <fieldset class="form-group position-relative has-icon-left mb-1">
                      <input type="text" class="form-control form-control-lg input-lg" name="btc_address" value="<?= set_value('btc_address') ?>"
                        placeholder="Your Btc Address" required>
                      <div class="form-control-position">
                        <i class="icon-btc"></i>
                      </div>
                    </fieldset>


                    <fieldset class="form-group position-relative has-icon-left">
                      <input type="password" class="form-control form-control-lg input-lg" name="password"
                        placeholder="Enter Password" required>
                      <div class="form-control-position">
                        <i class="icon-key3"></i>
                      </div>
                    </fieldset>
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="icon-unlock2"></i>
                      Register</button>
                  </form>
                </div>
                <p class="text-xs-center">Already have an account ? <a href="<?= site_url() ?>login"
                    class="card-link">Login</a></p>
              </div>
            </div>
          </div>
        </section>

<?= $this->endSection() ?>
