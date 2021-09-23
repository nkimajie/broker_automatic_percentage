<?= $this->extend('admins/layouts/default'); ?>

<?= $this->section('content') ?>


<div class="page-content">


<div class="content-body"><!-- stats -->
            <div class="row">
            <section id="basic-form-layouts">
                <div class="row match-height">

                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">

                            </div>
                            <div class="card-body">
                                <div class="card-block">

                                    <div class="card-text">
                                        <p>Set up your master settings.</p>
                                    </div>

                                    <form class="form" method="post" action="<?=  site_url() ?>admin/settingsPost" id="master">
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="icon-eye6"></i> Master Settings</h4>
                                            <div class="row">
                                                <div class="form-group">
                                                    <!-- flash messages -->
                                                    <?= view('flashMessages') ?>
                                                    <!-- flash messages end -->
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="userinput1">Bitcoin wallet ID</label>
                                                        <input type="text" id="userinput1" class="form-control border-primary" value="<?= $currentData->btc_id ?>" placeholder="Bitcoin wallet ID" name="btc_wallet">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="userinput1">Litecoin wallet ID</label>
                                                        <input type="text" id="userinput1" class="form-control border-primary" value="<?= $currentData->ltc_id ?>" placeholder="Litecoin wallet ID" name="ltc_wallet">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="userinput1">Ethereum wallet ID</label>
                                                        <input type="text" id="userinput1" class="form-control border-primary" value="<?= $currentData->eth_id ?>" placeholder="Ethereum wallet ID" name="eth_wallet">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="userinput1">USDT wallet ID</label>
                                                        <input type="text" id="userinput1" class="form-control border-primary" value="<?= $currentData->usdt_id ?>" placeholder="USDT wallet ID" name="usdt_wallet">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="userinput1">Referral Bonus</label>
                                                        <input type="text" id="userinput1" class="form-control border-primary" value="<?= $currentData->referral ?>" placeholder="Referral Bonus" name="referral">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="userinput1">Basic Percentage (%)</label>
                                                        <input type="text" id="userinput1" class="form-control border-primary" value="<?= $currentData->basic_percentage ?>"  name="basic_percentage">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="userinput1">Silver Percentage (%)</label>
                                                        <input type="text" id="userinput1" class="form-control border-primary" value="<?= $currentData->silver_percentage ?>"  name="silver_percentage">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="userinput1">Business Percentage (%)</label>
                                                        <input type="text" id="userinput1" class="form-control border-primary" value="<?= $currentData->business_percentage ?>"  name="business_percentage">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="userinput1">Premium Percentage (%)</label>
                                                        <input type="text" id="userinput1" class="form-control border-primary" value="<?= $currentData->premium_percentage ?>"  name="premium_percentage">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                       <div class="form-actions right">
                                            <button type="button" class="btn btn-warning mr-1">
                                                <i class="icon-cross2"></i> Cancel
                                            </button>
                                            <button type="submit" id="submit" class="btn btn-primary">
                                                <i class="icon-check2"></i> Save
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3"></div>

                </div>
            </div>
        </div>


</div>



<?= $this->endSection() ?>
