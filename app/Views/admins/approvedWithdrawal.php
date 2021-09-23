<?= $this->extend('admins/layouts/default'); ?>

<?= $this->section('content') ?>


<div class="page-content">
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Approved Withdrawal</h4>
    </div>
    <div class="card-bod table-responsive-xl">
    <p>View all approved withdrawal transaction history</p>
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
            <th>View Receipt</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php $i = 0; foreach($approvedWithdrawal as $row): $i++ ?>
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
                <?= $row->date ?>
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
            <th>View Receipt</th>
            <th>Action</th>
            </tr>
            </tfoot>
    </table>

    </div>
</div>
</div>




<?= $this->endSection() ?>
