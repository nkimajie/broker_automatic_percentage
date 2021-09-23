<?= $this->extend('user/layouts/default'); ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <h4 class="card-title" id="basic-layout-colored-form-control">User Profile</h4>

    </div>
    <div class="card-body">
        <div class="card-block">

            <div class="card-text">
                <p>Update your profile to enable us know you better.</p>
            </div>

            <form class="form" method="post" action="<?= base_url('users/profile') ?>">
                <div class="form-body">
                    <h4 class="form-section"><i class="icon-eye6"></i> About User</h4>
                    <div class="row">
                        <div class="form-group">
                            <!-- flash messages -->
                            <?= view('flashMessages') ?>
                            <!-- flash messages end -->
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userinput1">First Name</label>
                                <input type="text" id="userinput1" class="form-control border-primary" value="<?= $user->firstname ?>" placeholder="First Name" name="firstname">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userinput2">Last Name</label>
                                <input type="text" id="userinput2" class="form-control border-primary" value="<?= $user->lastname ?>" placeholder="Last name" name="lastname">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userinput3">Username</label>
                                <input type="text" id="userinput3" class="form-control border-primary" value="<?= $user->username ?>" placeholder="Username" name="username">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userinput4">Country</label>
                                <select name="country" id="" class="form-control border-primary">
                                    <option value="<?= $user->country ?>" selected="<?= $user->country ?>"><?= $user->country ?></option>
                                    <?php foreach($countries as $row): ?>
                                        <option value="<?= $row->country?>"><?= $row->country ?></option>
                                    <?php endforeach ?>
                                </select>
                                <!-- <input type="text" id="userinput4" class="form-control border-primary" value="<?= $user->country ?>" placeholder="Nick Name" name="country"> -->
                            </div>
                        </div>
                    </div>

                    <h4 class="form-section"><i class="icon-mail6"></i> Contact Info & Bio</h4>

                    <div class="form-group">
                        <label for="userinput5">Email</label>
                        <input class="form-control border-primary" name="email" type="email" value="<?= $user->email ?>" placeholder="email" id="userinput5" readonly>
                    </div>
                    <div class="form-group">
                        <label>Contact Number</label>
                        <input class="form-control border-primary" name="phone" id="userinput7" value="<?= $user->phone ?>" type="tel" placeholder="Contact Number">
                    </div>

                    <div class="form-group">
                        <label for="userinput8">Address</label>
                        <textarea id="userinput8" rows="5" class="form-control border-primary" value="<?= $user->address ?>" name="address" placeholder="Enter Address"><?= $user->address ?></textarea>
                    </div>

                    <h4 class="form-section">Payout Details</h4>

                    <div class="form-group">
                        <label for="userinput5">Wallet Type</label>
                        <!-- <input class="form-control border-primary" name="wallet_type" type="text" value="<?= $user->wallet_type ?>" placeholder="Wallet Type" id="userinput5" required> -->
                        <select class="form-control border-primary" name="wallet_type">
                          <option disabled>Select Wallet Type</option>
                          <option <?php if ($user->wallet_type == "Bitcoin") {echo "selected";} ?> value="Bitcoin">Bitcoin</option>
                          <option <?php if ($user->wallet_type == "Litecoin") {echo "selected";} ?> value="Litecoin">Litecoin</option>
                          <option <?php if ($user->wallet_type == "Etherum") {echo "selected";} ?> value="Etherum">Etherum</option>
                          <option <?php if ($user->wallet_type == "USDT") {echo "selected";} ?> value="USDT">USDT</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="userinput5">Wallet Address</label>
                        <input class="form-control border-primary" name="btc_address" type="text" value="<?= $user->btc_address ?>" placeholder="Wallet Address" id="userinput5" >
                    </div>
                    <div class="form-group">
                        <label for="userinput5">Paypal Tag</label>
                        <input class="form-control border-primary" name="paypal_tag" type="text" value="<?= $user->paypal_tag ?>" placeholder="Paypal Tag" id="userinput5" >
                    </div>
                    <div class="form-group">
                        <label for="userinput5">Zelle Tag</label>
                        <input class="form-control border-primary" name="zelle_tag" type="text" value="<?= $user->zelle_tag ?>" placeholder="Zelle Tag" id="userinput5" >
                    </div>
                    <div class="form-group">
                        <label for="userinput5">Cashapp Tag</label>
                        <input class="form-control border-primary" name="cashapp_tag" type="text" value="<?= $user->cashapp_tag ?>" placeholder="Cashapp Tag" id="userinput5" >
                    </div>


                    <!-- <div class="form-group">
                        <label for="userinput6">Website</label>
                        <input class="form-control border-primary" type="url" value="<?= $user->website ?>" placeholder="http://" id="userinput6">
                    </div> -->



                </div>
                <div class="form-actions right">

                    <button type="submit" class="btn btn-primary">
                        <i class="icon-check2"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<?= $this->endSection() ?>
