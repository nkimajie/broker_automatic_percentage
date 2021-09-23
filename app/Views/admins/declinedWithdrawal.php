<?= $this->extend('admins/layouts/default'); ?>

<?= $this->section('content') ?>


<div class="page-content">
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Declined Withdrawal</h4>
    </div>
    <div class="card-body table-responsive-xl">
    <p>View all declined withdrawal transaction history</p>
    <!-- flash messages -->
    <?= view('flashMessages') ?>
    <!-- flash messages end -->

    <table id="data_table" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Amount</th>
            <th>Payment Method</th>
            <th>View Receipt</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php $i = 0; foreach($declinedWithdrawal as $row): $i++ ?>
        <tr>
            <th scope="row">
                <?= $i ?>
            </th>
            <td><?= $row->email ?></td>
            <td>$ <?= $row->amount ?></td>
            <td> <?= $row->method ?> </td>
            <td>
                <?= $row->date ?>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
            <tfoot>
            <tr>
            <th>ID</th>
            <th>Email</th>
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
