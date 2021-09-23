<?= $this->extend('user/layouts/default'); ?>

<?= $this->section('content') ?>


<div class="page-content">
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Transaction History</h4>

    </div>
    <div class="card-body table-responsive-xl">

    <table id="data_table" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Transaction Type</th>
                <th>Amount</th>
                <th>Payment Method</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; foreach($user_history as $row): $i++ ?>
                <tr>
                    <th scope="row">
                        <?= $i ?>
                    </th>
                    <td><?= $row->type ?></td>
                    <td> <?= $row->amount ?> </td>
                    <td> <?= $row->method ?> </td>
                    <td><?= $row->status ?></td>
                    <td><?= $row->date ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Transaction Type</th>
                <th>Amount</th>
                <th>Payment Method</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </tfoot>
    </table>

    </div>
</div>
</div>


<?= $this->endSection() ?>
