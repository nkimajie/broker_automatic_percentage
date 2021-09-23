<?= $this->extend('admins/layouts/default'); ?>

<?= $this->section('content') ?>


<div class="page-content">
<div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pending Account</h4>
                </div>
                <div class="card-body table-responsive-xl">
                <p>You can fund user account and view user trading record</p>
                <!-- flash messages -->
                <?= view('flashMessages') ?>
                <!-- flash messages end -->
                <table id="data_table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Country</th>
                            <th>Wallet Balance</th>
                            <th>Invested Amount</th>
                            <th>Total Withdrawal</th>
                            <th>Bonus</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; foreach($verifiedUsers as $row): $i++ ?>
                                <tr>
                                    <th scope="row">
                                        <?= $i ?>
                                    </th>
                                    <td><?= $row->email ?></td>
                                    <td><?= $row->firstname ?> <?= $row->lastname ?></td>
                                    <td> <?= $row->phone ?> </td>
                                    <td><?= $row->country ?></td>
                                    <td><?= $row->wallet_bal ?></td>
                                    <td><?= $row->invested ?></td>
                                    <td><?= $row->withdrawal ?></td>
                                    <td><?= $row->bonus ?></td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-backdrop="false" data-target="#fundUser<?= $row->uuid ?>" id="fund" style="margin-bottom: 3px;">Fund</button>
                                        <button type="button" class="btn btn-danger btn-sm" id="deactivate" data-userId="<?= $row->uuid ?>" onclick="deactivate('<?= $row->uuid ?>')">Deactivate</button>
                                    </td>
                                </tr>

                                <!-- fund modal -->
                                <div class="modal fade text-xs-left" id="fundUser<?= $row->uuid ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel4">Fund User</h4>
                                            </div>
                                            <div class="modal-body">
                                            <form class="form" method="post" action="<?= base_url('admin/users') ?>">
                                                    <div class="form-body">
                                                        <h4 class="form-section"><i class="icon-eye6"></i> About User</h4>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="userinput1">Email</label>
                                                                    <input type="text" id="userinput1" class="form-control border-primary" value="<?= $row->email ?>" placeholder="Email" name="email" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="userinput2">Name</label>
                                                                    <input type="text" id="userinput2" class="form-control border-primary" value="<?= $row->firstname ?> <?= $row->lastname ?>" placeholder="Name" name="name" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="userinput1">Wallet Balance</label>
                                                                    <input type="number" id="userinput1" class="form-control border-primary" value="<?= $row->wallet_bal ?>" placeholder="wallet_bal" name="wallet_bal">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="userinput2">Invested Amount</label>
                                                                    <input type="number" id="userinput2" class="form-control border-primary" value="<?= $row->invested ?>" placeholder="invested" name="invested">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="userinput1">Total Withdrawal</label>
                                                                    <input type="number" id="userinput1" class="form-control border-primary" value="<?= $row->withdrawal ?>" placeholder="withdrawal" name="withdrawal">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="userinput2">Trading Bonus</label>
                                                                    <input type="number" id="userinput2" class="form-control border-primary" value="<?= $row->bonus ?>" placeholder="Last name" name="bonus">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="userinput4">Plan Type</label>
                                                                    <select name="subscription" id="" class="form-control border-primary">
                                                                        <option value="<?= $row->subscription ?>" selected="<?= $row->subscription ?>"><?= $row->subscription ?></option>
                                                                            <option value="BASIC">BASIC</option>
                                                                            <option value="SILVER">SILVER</option>
                                                                            <option value="BUSINESS">BUSINESS</option>
                                                                            <option value="PREMIUM">PREMIUM</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <!-- <div class="form-actions right">
                                                        <button type="button" class="btn btn-warning mr-1">
                                                            <i class="icon-cross2"></i> Cancel
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="icon-check2"></i> Save
                                                        </button>
                                                    </div> -->
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-outline-primary">Save changes</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                            </tbody>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Country</th>
                            <th>Wallet Balance</th>
                            <th>Invested Amount</th>
                            <th>Total Withdrawal</th>
                            <th>Bonus</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                </table>

                </div>
            </div>


</div>


<script>

    // deactivate account
    function deactivate(userId){
        // var userId = $(this).attr('data-userId');
        var url = '<?= base_url('admin/deactivateAcct') ?>'
        // console.log(userId);
        Swal.fire({
            title: 'Are you sure?',
            text: "User Account will be deactivated!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, deactivate it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                type: 'POST',
                url: url,
                data: {userId},
                success: function(data) {
                    Swal.fire(
                    'Deleted!',
                    'User Deposit has been deactivated.',
                    'success'
                    );
                    location.reload();
                },

                dataType: 'html'
            });
                // Swal.fire(
                // 'Deleted!',
                // 'User has been deleted.',
                // 'success'
                // )
            }
        })
    }
</script>

<?= $this->endSection() ?>
