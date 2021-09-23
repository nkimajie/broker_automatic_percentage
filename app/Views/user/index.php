<?= $this->extend('user/layouts/default'); ?>

<?= $this->section('content') ?>


<div class="page-content">
	<section class="row">
		<div class="col-12 col-lg-12">
			<div class="row">
				<div class="col-6 col-lg-3 col-md-6">
					<div class="card">
						<div class="card-body px-3 py-4-5">
							<div class="row">
								<div class="col-md-4">
									<div class="stats-icon purple">
									<i class="fas fa-wallet"></i>
									</div>
								</div>
								<div class="col-md-8">
									<h6 class="text-muted font-semibold">Wallet Balance</h6>
									<h6 class="font-extrabold mb-0">$ <?= $user->wallet_bal ?></h6>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-6 col-lg-3 col-md-6">
					<div class="card">
						<div class="card-body px-3 py-4-5">
							<div class="row">
								<div class="col-md-4">
									<div class="stats-icon blue">
									<i class="fas fa-money-bill-wave-alt"></i>
									</div>
								</div>
								<div class="col-md-8">
									<h6 class="text-muted font-semibold">Invested</h6>
									<h6 class="font-extrabold mb-0">$ <?= $user->invested ?></h6>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-6 col-lg-3 col-md-6">
					<div class="card">
						<div class="card-body px-3 py-4-5">
							<div class="row">
								<div class="col-md-4">
									<div class="stats-icon green">
									<i class="iconly-boldShow"></i>
									</div>
								</div>
								<div class="col-md-8">
									<h6 class="text-muted font-semibold">Account Status</h6>
									<h6 class="font-extrabold mb-0"><?= ucfirst($user->account_status) ?></h6>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-6 col-lg-3 col-md-6">
					<div class="card">
						<div class="card-body px-3 py-4-5">
							<div class="row">
								<div class="col-md-4">
									<div class="stats-icon red">
										<i class="iconly-boldBookmark"></i>
									</div>
								</div>
								<div class="col-md-8">
									<h6 class="text-muted font-semibold">Account Type</h6>
									<h6 class="font-extrabold mb-0"><?= ucfirst($user->subscription) ?></h6>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<div class="card">
						<div class="card-body px-3 py-4-5">
							<div class="row">
								<div class="col-md-4">
									<div class="stats-icon purple">
									<i class="fas fa-money-bill-wave-alt"></i>
									</div>
								</div>
								<div class="col-md-8">
									<h6 class="text-muted font-semibold">Total Withdrawal</h6>
									<h6 class="font-extrabold mb-0">$ <?= $user->withdrawal ?></h6>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="card">
						<div class="card-body px-3 py-4-5">
							<div class="row">
								<div class="col-md-4">
									<div class="stats-icon blue">
										<i class="fas fa-money-bill-wave-alt"></i>
									</div>
								</div>
								<div class="col-md-8">
									<h6 class="text-muted font-semibold">Referral Bonus</h6>
									<h6 class="font-extrabold mb-0">$ <?php $i = count($referral); $j= $i*$currentData->referral; echo $j; ?></h6>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="card">
						<div class="card-body px-3 py-4-5">
							<div class="row">
								<div class="col-md-4">
									<div class="stats-icon green">
										<i class="iconly-boldAdd-User"></i>
									</div>
								</div>
								<div class="col-md-8">
									<h6 class="text-muted font-semibold">Total Referral</h6>
									<h6 class="font-extrabold mb-0"><?= count($referral); ?></h6>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="card">
                <div class="card-header">
                    <h4 class="card-title">Referral link</h4>
                </div>
                <div class="card-body container">

                  <div class="input-group">
                      <input readonly class="form-control width100" type="text" value="<?= site_url() ?>register/<?= $user->uuid ?>" id="referral_copy">
                      <span class="input-group-btn" >
                          <button class="btn btn-info" onclick="referral()">Copy To Clipboard</button>
                      </span>
                  </div>
                  <small>Referral bonus will automatically be added on withdrawal.</small>


                </div>
            </div>
            <script type="text/javascript">

              function referral() {
              /* Get the text field */
              var copyText = document.getElementById("referral_copy");

              document.getElementById("referral_copy").removeAttribute('disabled');
              /* Select the text field */
              copyText.select();
              copyText.setSelectionRange(0, 99999); /* For mobile devices */

              /* Copy the text inside the text field */
              document.execCommand("copy");

              /* Alert the copied text */
              Swal.fire({
                icon: 'success',
                title: 'Text copied successfully',

              })
              // alert("Copied the text: " + copyText.value);
              }

            </script>
			<div class="row">
				<div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <ul class="list-inline text-xs-center pt-2 m-0">
                            <li class="mr-1">
                                <h6> <span class="grey darken-1">Network Activities</span></h6>
                            </li>
                        </ul>
                    </div>
                    <iframe id="tradingview_8c5c7" src="https://s.tradingview.com/widgetembed/?frameElementId=tradingview_8c5c7&amp;symbol=AAPL&amp;interval=D&amp;hidesidetoolbar=0&amp;symboledit=1&amp;saveimage=0&amp;toolbarbg=f1f3f6&amp;studies=ROC%40tv-basicstudies%1FStochasticRSI%40tv-basicstudies%1FMASimple%40tv-basicstudies&amp;theme=Dark&amp;style=1&amp;timezone=exchange&amp;withdateranges=1&amp;showpopupbutton=1&amp;studies_overrides=%7B%7D&amp;overrides=%7B%7D&amp;enabled_features=%5B%5D&amp;disabled_features=%5B%5D&amp;showpopupbutton=1&amp;locale=en&amp;utm_source=www.autofxnetworks.online&amp;utm_medium=widget&amp;utm_campaign=chart&amp;utm_term=AAPL" style="width: 100%; height: 600px; margin: 0 !important; padding: 0 !important;" frameborder="0" allowtransparency="true" scrolling="no" allowfullscreen=""></iframe>
                </div>

				</div>
			</div>

		</div>

	</section>
</div>


<?= $this->endSection() ?>
