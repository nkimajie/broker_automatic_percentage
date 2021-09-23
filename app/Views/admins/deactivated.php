<?= $this->extend('admins/layouts/default'); ?>

<?= $this->section('content') ?>


<div class="page-content">
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Deactivated Accounts</h4>
    </div>
    <div class="card-body table-responsive-xl">

    <table id="data_table" class="table table-striped table-bordered" style="width:100%">
    <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 0; foreach($deactivatedAcct as $row): $i++ ?>
                <tr>
                    <th scope="row">
                        <?= $i ?>
                    </th>
                    <td><?= $row->email ?></td>
                    <td><?= $row->firstname ?> <?= $row->lastname ?></td>
                    <td> <?= $row->phone ?> </td>
                    <td> <?= $row->country ?> </td>
                    <td>
                        <button type="button" class="btn btn-success btn-sm" data-userId="<?= $row->uuid ?>" onclick="activate('<?= $row->uuid ?>')" id="activate">Activate</button>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>Date</th>
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
        function activate(userId){
            // var userId = $(this).attr('data-userId');
            var url = '<?= base_url('admin/activateAcct') ?>'
            console.log(userId);
            Swal.fire({
                title: 'Are you sure?',
                text: "User Account will be activated!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, activate it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                    type: 'POST',
                    url: url,
                    data: {userId},
                    success: function(data) {
                        Swal.fire(
                        'Deleted!',
                        'User Account has been activated.',
                        'success'
                        );
                        location.reload();
                    },

                    dataType: 'html'
                });

                }
            })
        }

    $(document).ready(function() {
      $('#data_table2').DataTable();
    } );

    </script>


<?= $this->endSection() ?>
