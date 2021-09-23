<?= $this->extend('landing/layout/default') ?>

<?= $this->section('content') ?>


<!-- Banner Area Starts -->
<section class="banner-area">
			<div class="banner-overlay">
				<div class="banner-text text-center">
					<div class="container">
						<!-- Section Title Starts -->
						<div class="row text-center">
							<div class="col-xs-12">
								<!-- Title Starts -->
								<h2 class="title-head">our <span>services</span></h2>
								<!-- Title Ends -->
								<hr>
								<!-- Breadcrumb Starts -->
								<ul class="breadcrumb">
									<li><a href="index.html"> home</a></li>
									<li>services</li>
								</ul>
								<!-- Breadcrumb Ends -->
							</div>
						</div>
						<!-- Section Title Ends -->
					</div>
				</div>
			</div>
		</section>
		<!-- Banner Area Ends -->
		<!-- Section Services Starts -->
        <section class="services">
			<div class="container">
				<div class="row">
					<!-- Service Box Starts -->
					<div class="col-md-6 service-box">
						<div>
							<img src="<?= site_url(); ?>assets/images/icons/orange/download-bitcoin.png" alt="download bitcoin">
							<div class="service-box-content">
								<h3>Bitcoin Escrow Service</h3>
								<p>A Bitcoin escrow service is a mediator service that keeps the money for a transaction between strangers in safekeeping until the Bitcoins (or goods) are handed over.</p>
							</div>
						</div>
					</div>
					<!-- Service Box Ends -->
					<!-- Service Box Starts -->
					<div class="col-md-6 service-box">
						<div>
							<img src="<?= site_url(); ?>assets/images/icons/orange/add-bitcoins.png" alt="add bitcoins">
							<div class="service-box-content">
								<h3>Bitcoin Mining</h3>
								<p>Bitcoin mining is the process of creating new bitcoin by solving a computational puzzle. Bitcoin mining is necessary to maintain the ledger of transactions upon which bitcoin is based. </p>
							</div>
						</div>
					</div>
					<!-- Service Box Ends -->
					<!-- Service Box Starts -->
					<div class="col-md-6 service-box">
						<div>
							<img src="<?= site_url(); ?>assets/images/icons/orange/buy-sell-bitcoins.png" alt="buy and sell bitcoins">
							<div class="service-box-content">
								<h3>Software Development</h3>
								<p>Software development is the process of conceiving, specifying, designing, programming, documenting, testing, and bug fixing involved in creating and maintaining applications, frameworks, or other software components</p>
							</div>
						</div>
					</div>
					<!-- Service Box Ends -->
					<!-- Service Box Starts -->
					<div class="col-md-6 service-box">
						<div>
							<img src="<?= site_url(); ?>assets/images/icons/orange/strong-security.png" alt="strong security"/>
							<div class="service-box-content">
								<h3>Bitcoin Transaction</h3>
								<p>A transaction is a transfer of value between Bitcoin wallets that gets included in the block chain. All transactions are broadcast to the network and usually begin to be confirmed within 10-20 minutes, through a process called mining.</p>
							</div>
						</div>
					</div>
					<!-- Service Box Ends -->
					<!-- Service Box Starts -->
					<div class="col-md-6 service-box">
						<div>
							<img src="<?= site_url(); ?>assets/images/icons/orange/world-coverage.png" alt="world coverage"/>
							<div class="service-box-content">
								<h3>Bitcoin Exchange</h3>
								<p>A bitcoin exchange is a digital marketplace where traders can buy and sell bitcoins using different fiat currencies or altcoins.</p>
							</div>
						</div>
					</div>
					<!-- Service Box Ends -->
					<!-- Service Box Starts -->
					<div class="col-md-6 service-box">
						<div>
							<img src="<?= site_url(); ?>assets/images/icons/orange/payment-options.png" alt="payment options"/>
							<div class="service-box-content">
								<h3>Bitcoin Investment</h3>
								<p>As a general concept, Bitcoin is a system for securely buying, storing, and using money digitally. Once you have Bitcoins, stored in a Bitcoin wallet, you're welcome to use them as currency or you can hold onto them as an asset to invest in (much like gold)</p>
							</div>
						</div>
					</div>
					<!-- Service Box Ends -->

				</div>
			</div>
		</section>
		<!-- Section Services Ends -->


<?=  $this->endSection() ?>