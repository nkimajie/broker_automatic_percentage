<?= $this->extend('landing/layout/auth_default') ?>

<?= $this->section('content') ?>


<section class="flexbox-container">
                    <div class="col-md-4 offset-md-4 col-xs-10 offset-xs-1  box-shadow-2 p-0">
                        <div class="card border-grey border-lighten-3 m-0">
                            <div class="card-header no-border">
                                <div class="card-title text-xs-center">
                                    <div class="p-1">
                                        <a href="<?= site_url() ?>"><img src="<?= site_url() ?>public/logo3.png" width="200px" alt="logo"></a>
                                    </div>
                                </div>
                                <h6 class="card-subtitle line-on-side text-muted text-xs-center font-small-3 pt-2">
                                    <span>Login</span></h6>
								<!-- flash messages -->
									<div class="text-center">
										<?= view('flashMessages') ?>
									</div>
								<!-- flash messages end -->
                            </div>
                            <div class="card-body collapse in">
                                <div class="card-block">
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
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="">
                                    <p class="float-sm-left text-xs-center m-0"><a href="<?= site_url() ?>forgot"
                                            class="card-link">Forgot password?</a></p>
                                    <p class="float-sm-right text-xs-center m-0">Don't have an account? <a
                                            href="<?= site_url() ?>register" class="card-link">Sign Up</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

<?= $this->endSection() ?>
