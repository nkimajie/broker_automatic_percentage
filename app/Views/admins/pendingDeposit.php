<?= $this->extend('admins/layouts/default'); ?>

<?= $this->section('content') ?>


<div class="page-content">
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Pending Deposit</h4>
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
            <th>Amount</th>
            <th>Payment Method</th>
            <th>View Receipt</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php $i = 0; foreach($pendingDeposit as $row): $i++ ?>
        <tr>
            <th scope="row">
                <?= $i ?>
            </th>
            <td><?= $row->email ?></td>
            <td>$ <?= $row->amount ?></td>
            <td> <?= $row->method ?> </td>
            <td>
                <a href="<?= $row->snapshot ?>" target="_blank">
                    <button type="button" class="btn btn-primary btn-sm">View Payment Receipt</button>
                </a>
            </td>
            <td>
                <button type="button" class="btn btn-success btn-sm" data-userId="<?= $row->invested_id ?>" onclick="approveDeposit('<?= $row->invested_id ?>','<?= $row->amount ?>','<?= $row->email ?>')" id="accept">Accept</button>
                <button type="button" class="btn btn-danger btn-sm" data-userId="<?= $row->invested_id ?>" onclick="declineDeposit('<?= $row->invested_id ?>')" id="decline">Decline</button>
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


<!-- ////////////////////////////////////////////////////////////////////////////-->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // $(document).ready(function(){
            function approveDeposit(investedId, amount, email){
              console.log(amount);
                // var investedId = $(this).attr('data-userId');
                var url = '<?= base_url('admin/approveDeposit') ?>'
                // console.log(investedId);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "User Deposit will be approved!",
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
                        data: {investedId, amount, email},
                        success: function(data) {
                            Swal.fire(
                            'Deleted!',
                            'User Deposit has been verified.',
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
            function declineDeposit(investedId){
                // var investedId = $(this).attr('data-userId');
                var url = '<?= base_url('admin/declineWithdrawal') ?>'
                // console.log(investedId);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "User Deposit will be declined!",
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
                            'User Deposit has been declined.',
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
        //})
    </script>



<?= $this->endSection() ?>
