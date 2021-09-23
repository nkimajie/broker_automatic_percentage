<?= $this->extend('admins/layouts/default'); ?>

<?= $this->section('content') ?>


<div class="page-content">
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Pending Withdrawal</h4>
    </div>
    <div class="card-body table-responsive-xl">
    <p>You can accept or decline pending withdrawal to reflect in user transaction history</p>
    <!-- flash messages -->
    <?= view('flashMessages') ?>
    <!-- flash messages end -->

    <table id="data_table" class="table table-striped table-bordered" style="width:100%">
    <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>View User Details</th>
                    <th>Amount</th>
                    <th>Payment Method</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 0; foreach($pendingWithdrawal as $row): $i++ ?>
                <tr>
                    <th scope="row">
                        <?= $i ?>
                    </th>
                    <td><?= $row->email ?></td>
                    <td>
                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#userDetails<?= $row->invested_id ?>">
                        View User Details
                      </button>
                    </td>
                    <td>$ <?= $row->amount ?></td>
                    <td> <?= $row->method ?> </td>
                    <td>
                        <button type="button" class="btn btn-success btn-sm" data-userId="<?= $row->invested_id ?>" onclick="approveWithdrawal('<?= $row->invested_id ?>', '<?= $row->amount ?>', '<?= $row->email ?>', '<?= $row->firstname ?>')" id="accept">Accept</button>
                        <button type="button" class="btn btn-danger btn-sm" data-userId="<?= $row->invested_id ?>" onclick="declineWithdrawal('<?= $row->invested_id ?>')" id="decline">Decline</button>
                    </td>
                </tr>



                <!-- Modal -->
                <div class="modal fade" id="userDetails<?= $row->invested_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">User Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                          <label for="Wallet Type">Name</label>
                          <input type="text" class="form-control" readonly value="<?= $row->firstname ?> <?= $row->lastname ?>">
                        </div>
                        <div class="form-group">
                          <label for="Wallet Type">Wallet Type</label>
                          <input type="text" class="form-control" readonly value="<?= $row->wallet_type ?>">
                        </div>
                        <div class="form-group">
                          <label for="Wallet Type">Wallet Address</label>
                          <input type="text" class="form-control" readonly value="<?= $row->btc_address ?>">
                        </div>
                        <div class="form-group">
                          <label for="Wallet Type">Paypal Tag</label>
                          <input type="text" class="form-control" readonly value="<?= $row->paypal_tag ?>">
                        </div>
                        <div class="form-group">
                          <label for="Wallet Type">Zelle Tag</label>
                          <input type="text" class="form-control" readonly value="<?= $row->zelle_tag ?>">
                        </div>
                        <div class="form-group">
                          <label for="Wallet Type">Cashapp Tag</label>
                          <input type="text" class="form-control" readonly value="<?= $row->cashapp_tag ?>">
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
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
                <th>View User Details</th>
                <th>Amount</th>
                <th>Payment Method</th>
                <th>Action</th>
            </tr>
            </tfoot>
    </table>

    </div>
</div>
</div>



 <!-- ////////////////////////////////////////////////////////////////////////////-->
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
            function approveWithdrawal(investedId, amount, email, name){
                // var investedId = $(this).attr('data-userId');
                var url = '<?= base_url('admin/approveWithdrawal') ?>'

                Swal.fire({
                    title: 'Are you sure?',
                    text: "User Withdrawal will be approved!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, approve it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: {investedId, amount, email, name},
                            success: function(data) {
                                Swal.fire(
                                'Approved!',
                                'User Withdrawal has been verified.',
                                'success'
                                );
                                location.reload();
                            },

                            dataType: 'html'
                        });

                    }
                })
            }

            // decline account
            function declineWithdrawal(investedId){
                // var investedId = $(this).attr('data-userId');
                var url = '<?= base_url('admin/declineWithdrawal') ?>'
                // console.log(investedId);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "User Withdrawal will be declined!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, decline it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                        type: 'POST',
                        url: url,
                        data: {investedId},
                        success: function(data) {
                            Swal.fire(
                            'Deleted!',
                            'User Withdrawal has been declined.',
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
