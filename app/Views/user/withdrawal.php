<?= $this->extend('user/layouts/default'); ?>

<?= $this->section('content') ?>


<div class="page-content">
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Withdrawal</h4>
        <div class="card-body">
            <div class="card-block">

                <div class="card-text">
                    <p class="card-text">Complete the form below to process withdrawal.</p>
                </div>

                <form class="form" method="post" action="<?= base_url('users/withdrawal') ?>" enctype="multipart/form-data">
                    <!-- flash messages -->
                    <?= view('flashMessages') ?>
                    <!-- flash messages end -->
                    <div class="form-body">
                        <h4 class="form-section"><i class="icon-head"></i> Personal Info</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1" class="sr-only">First Name</label>
                                    <input type="text" id="projectinput1" class="form-control" value="<?= $user->firstname ?>" placeholder="First Name" name="firstname" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput2" class="sr-only">Last Name</label>
                                    <input type="text" id="projectinput2" class="form-control" value="<?= $user->lastname ?>" placeholder="Last Name" name="lastname" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput3" class="sr-only">E-mail</label>
                                    <input type="text" id="projectinput3" class="form-control" value="<?= $user->email ?>" placeholder="E-mail" name="email" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput4" class="sr-only">Country</label>
                                    <input type="text" id="projectinput4" class="form-control" value="<?= $user->country ?>" placeholder="Country" name="country" required readonly>
                                </div>
                            </div>
                        </div>

                        <h4 class="form-section"><i class="icon-clipboard4"></i> Transaction info</h4>

                        <div class="form-group">
                            <label for="companyName" class="sr-only">Select Withdrawal Method</label>
                            <select id="projectinput5" name="paymentMethod" class="form-control" required>
                                <option value="none" selected="" disabled="">Select Withdrawal Method</option>
                                <option value="Paypal">Paypal</option>
                                <option value="Bitcoin">Bitcoin</option>
                                <option value="USDT">USDT</option>
                                <option value="Litecoin">Litecoin</option>
                                <option value="Ethereum">Ethereum</option>
                                <option value="Zelle">Zelle</option>
                                <option value="Bank">Bank</option>
                            </select>
                        </div>

                        <!-- <div class="form-group">
                            <label for="companyName" class="sr-only">Select Plan</label>
                            <select id="plan" name="plan" class="form-control" required>
                                <option value="none" selected="" disabled="">Select Plan</option>
                                <?php foreach($plans as $row): ?>
                                <option value="<?= $row->plan_id ?>_<?= $row->invest ?>"><?= $row->plan_name ?></option>
                                <?php endforeach ?>
                            </select>
                        </div> -->

                        <div class="form-group">
                            <label for="projectinput2" class="sr-only">Amount</label>
                            <input type="number" id="amount" class="form-control" value="" placeholder="amount" name="amount" required >
                        </div>

                        <!-- <div class="form-group">
                            <label>Upload screenshot</label>
                            <label id="projectinput7" class="file center-block">
                                <input type="file" id="file" name="depositShot" required>
                                <span class="file-custom"></span>
                            </label>
                        </div> -->

                    </div>

                    <!-- <div class="form-actions">
                        <button type="button" class="btn btn-outline-warning mr-1">
                            <i class="icon-cross2"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="icon-check2"></i> Save
                        </button>
                    </div> -->
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-1 mb-1">Withdraw</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>


<?= $this->endSection() ?>
