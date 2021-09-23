<?= $this->extend('user/layouts/default'); ?>

<?= $this->section('content') ?>


<div class="page-content">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Bitcoin Address</h4>
        </div>
        <div class="card-body container">

            <div class="input-group">
                <input readonly class="form-control width100" type="text" value="<?= $currentMaster->btc_id ?>" id="referral_copy">
                <span class="input-group-btn" >
                    <button class="btn btn-info" onclick="referral()">Copy To Clipboard</button>
                </span>
            </div>


        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Ethereum Address</h4>
        </div>
        <div class="card-body container">

            <div class="input-group">
                <input readonly class="form-control width100" type="text" value="<?= $currentMaster->eth_id ?>" id="ethereum">
                <span class="input-group-btn" >
                    <button class="btn btn-info" onclick="ethereum()">Copy To Clipboard</button>
                </span>
            </div>


        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">USDT Address</h4>
        </div>
        <div class="card-body container">

            <div class="input-group">
                <input readonly class="form-control width100" type="text" value="<?= $currentMaster->usdt_id ?>" id="usdt">
                <span class="input-group-btn" >
                    <button class="btn btn-info" onclick="usdt()">Copy To Clipboard</button>
                </span>
            </div>


        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Litecoin Address</h4>
        </div>
        <div class="card-body container">

            <div class="input-group">
                <input readonly class="form-control width100" type="text" value="<?= $currentMaster->ltc_id ?>" id="litecoin">
                <span class="input-group-btn" >
                    <button class="btn btn-info" onclick="litecoin()">Copy To Clipboard</button>
                </span>
            </div>


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


    function litecoin() {
      /* Get the text field */
      var copyText = document.getElementById("litecoin");

      document.getElementById("litecoin").removeAttribute('disabled');
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


    function ethereum() {
      /* Get the text field */
      var copyText = document.getElementById("ethereum");

      document.getElementById("ethereum").removeAttribute('disabled');
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

    function usdt() {
      /* Get the text field */
      var copyText = document.getElementById("usdt");

      document.getElementById("usdt").removeAttribute('disabled');
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
        <div class="card col-sm-6">
            <div class="card-header">
                <h4 class="card-title">Deposit</h4>
            </div>
            <div class="card-body">
                <div class="card-block">

                    <div class="card-text">
                        <p class="card-text">Complete the form below to approve deposit.</p>
                    </div>

                    <form class="form" method="post" action="<?= base_url('users/deposit') ?>" enctype="multipart/form-data">
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
                                <label for="companyName" class="sr-only">Select Payment Method</label>
                                <select id="projectinput5" name="paymentMethod" class="form-control" required>
                                    <option value="none" selected="" disabled="">Select Payment Method</option>
                                    <!-- <option value="Paypal">Paypal</option> -->
                                    <option value="Bitcoin">Bitcoin</option>
                                    <option value="Litecoin">Litecoin</option>
                                    <option value="Ethereum">Ethereum</option>
                                    <option value="USDT">USDT</option>
                                </select>
                            </div>

                            <!-- <div class="form-group">
                                <label for="companyName" class="sr-only">Select Plan</label>
                                <select id="plan" name="plan" class="form-control" required>
                                    <option value="none" selected="" disabled="">Select Plan</option>
                                    <option value="Basic">Basic</option>
                                    <option value="Silver">Silver</option>
                                    <option value="Business">Business</option>
                                    <option value="Premium">Premium</option>
                                </select>
                            </div> -->

                            <div class="form-group">
                                <label for="projectinput2" class="sr-only">Amount</label>
                                <!-- <input type="number" id="amount" class="form-control" value="" placeholder="amount" name="amount" required readonly> -->
                                <input type="number" class="form-control" value="" placeholder="amount" name="amount" required >
                            </div>

                            <div class="mb-3">
                                <label for="formFile" class="form-label">Upload screenshot</label>
                                <input class="form-control" name="depositShot" type="file" id="formFile">
                            </div>

                            <!-- <div class="form-group">
                                <label>Upload screenshot</label>
                                <label id="projectinput7" class="file center-block">
                                    <input type="file" id="file" name="depositShot" required>
                                    <span class="file-custom"></span>
                                </label>
                            </div> -->

                        </div>

                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <h4 class="card-title">- PREMIUM PLAN -</h4>
                        <p class="card-text">Get 41,400 USD for $10000.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                             24x7 support <i class="fas fa-check-circle" style="color:green;"></i>
                        </li>
                        <li class="list-group-item">
                            Secured trading <i class="fas fa-check-circle" style="color:green;"></i>
                        </li>
                        <li class="list-group-item">
                            Trading bonus <i class="fas fa-check-circle" style="color:green;"></i>
                        </li>
                        <li class="list-group-item">
                           Trading alert <i class="fas fa-check-circle" style="color:green;"></i>
                        </li>
                        <li class="list-group-item">
                            Professional live trade <i class="fas fa-check-circle" style="color:green;"></i>
                        </li>
                        <li class="list-group-item">
                           Unlimited Withdrawal method <i class="fas fa-check-circle" style="color:green;"></i>
                        </li>
                        <li class="list-group-item">
                            Personal account manager <i class="fas fa-check-circle" style="color:green;"></i>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <h4 class="card-title">- Other Plans -</h4>
                        <p class="card-text">Select a plan with any amount suitable to you.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            24x7 support <i class="fas fa-check-circle" style="color:green;"></i>
                        </li>
                        <li class="list-group-item">
                            Secured trading <i class="fas fa-check-circle" style="color:green;"></i>
                        </li>
                        <li class="list-group-item">
                            Trading bonus <i class="fas fa-check-circle" style="color:green;"></i>
                        </li>
                        <li class="list-group-item">
                            Maximum benefit <i class="fas fa-check-circle" style="color:green;"></i>
                        </li>
                        <li class="list-group-item">
                            <span class="tag tag-default tag-pill bg-info float-xs-right"></span>
                            NB: Chat with our agent to inform you of your trading benefit
                        </li>

                    </ul>

                </div>
            </div>
        </div> -->
    </div>


    <!-- <div class="row match-height">
        <div class="col-xl-4 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <h4 class="card-title">- BRONZE PLAN -</h4>
                        <p class="card-text">Get 6250 USD for $700.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">

                            24x7 support <i class="fas fa-check-circle" style="color:green;"></i>
                        </li>
                        <li class="list-group-item">
                            Secured trading <i class="fas fa-check-circle" style="color:green;"></i>
                        </li>
                        <li class="list-group-item">
                            Trading bonus <i class="fas fa-check-circle" style="color:green;"></i>
                        </li>
                        <li class="list-group-item">
                            Trading alert <i class="far fa-times-circle" style="color:red";></i>
                        </li>
                        <li class="list-group-item">
                            Professional live trade <i class="far fa-times-circle" style="color:red";></i>
                        </li>
                        <li class="list-group-item">
                            Unlimited Withdrawal method <i class="far fa-times-circle" style="color:red";></i>
                        </li>
                        <li class="list-group-item">
                            Personal account manager <i class="far fa-times-circle" style="color:red";></i>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <h4 class="card-title">- SLIVER PLAN -</h4>
                        <p class="card-text">Get 10,070 USD for $1000.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            24x7 support <i class="fas fa-check-circle" style="color:green;"></i>
                        </li>
                        <li class="list-group-item">
                            Secured trading <i class="fas fa-check-circle" style="color:green;"></i>
                        </li>
                        <li class="list-group-item">
                            Trading bonus <i class="fas fa-check-circle" style="color:green;"></i>
                        </li>
                        <li class="list-group-item">
                            Trading alert <i class="fas fa-check-circle" style="color:green;"></i>
                        </li>
                        <li class="list-group-item">
                            Professional live trade <i class="fas fa-check-circle" style="color:green;"></i>
                        </li>
                        <li class="list-group-item">
                            Unlimited Withdrawal method <i class="far fa-times-circle" style="color:red";></i>
                        </li>
                        <li class="list-group-item">
                            Personal account manager <i class="far fa-times-circle" style="color:red";></i>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <h4 class="card-title">- GOLD PLAN -</h4>
                        <p class="card-text">Get 29,400 USD for $7000.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                           24x7 support <i class="fas fa-check-circle" style="color:green;"></i>
                        </li>
                        <li class="list-group-item">
                            Secured trading <i class="fas fa-check-circle" style="color:green;"></i>
                        </li>
                        <li class="list-group-item">
                            Trading bonus <i class="fas fa-check-circle" style="color:green;"></i>
                        </li>
                        <li class="list-group-item">
                           Trading alert <i class="fas fa-check-circle" style="color:green;"></i>
                        </li>
                        <li class="list-group-item">
                            Professional live trade <i class="fas fa-check-circle" style="color:green;"></i>
                        </li>
                        <li class="list-group-item">
                            Unlimited Withdrawal method <i class="fas fa-check-circle" style="color:green;"></i>
                        </li>
                        <li class="list-group-item">
                            Personal account manager <i class="far fa-times-circle" style="color:red";></i>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div> -->

</div>


<?= $this->endSection() ?>
