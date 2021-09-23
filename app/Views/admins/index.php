<?= $this->extend('admins/layouts/default'); ?>

<?= $this->section('content') ?>


<div class="page-content">
	<section class="row">
		<div class="col-12 col-lg-12">
			<div class="row">
				<div class="col-6 col-lg-3 col-md-6">
					<div class="card">
						<div class="card-body px-3 py-4-5">
							<div class="row">
								<div class="col-md-4">
									<div class="stats-icon purple">
									<i class="fas fa-wallet"></i>
									</div>
								</div>
								<div class="col-md-8">
									<h6 class="text-muted font-semibold">Users</h6>
									<h6 class="font-extrabold mb-0"><?= count($users) ?></h6>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-6 col-lg-3 col-md-6">
					<div class="card">
						<div class="card-body px-3 py-4-5">
							<div class="row">
								<div class="col-md-4">
									<div class="stats-icon blue">
									<i class="fas fa-money-bill-wave-alt"></i>
									</div>
								</div>
								<div class="col-md-8">
									<h6 class="text-muted font-semibold">Admin</h6>
									<h6 class="font-extrabold mb-0"><?= count($admins) ?></h6>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-6 col-lg-3 col-md-6">
					<div class="card">
						<div class="card-body px-3 py-4-5">
							<div class="row">
								<div class="col-md-4">
									<div class="stats-icon green">
									<i class="iconly-boldShow"></i>
									</div>
								</div>
								<div class="col-md-8">
									<h6 class="text-muted font-semibold">Pending Account</h6>
									<h6 class="font-extrabold mb-0"><?= count($pendingAcct) ?></h6>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-6 col-lg-3 col-md-6">
					<div class="card">
						<div class="card-body px-3 py-4-5">
							<div class="row">
								<div class="col-md-4">
									<div class="stats-icon red">
										<i class="iconly-boldBookmark"></i>
									</div>
								</div>
								<div class="col-md-8">
									<h6 class="text-muted font-semibold">Pending Deposit</h6>
									<h6 class="font-extrabold mb-0"><?= count($pendingDeposit) ?></h6>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<div class="card">
						<div class="card-body px-3 py-4-5">
							<div class="row">
								<div class="col-md-4">
									<div class="stats-icon purple">
									<i class="fas fa-money-bill-wave-alt"></i>
									</div>
								</div>
								<div class="col-md-8">
									<h6 class="text-muted font-semibold">Pending Withdrawal</h6>
									<h6 class="font-extrabold mb-0">$<?= count($pendingWithdrawal) ?></h6>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="card">
						<div class="card-body px-3 py-4-5">
							<div class="row">
								<div class="col-md-4">
									<div class="stats-icon blue">
										<i class="fas fa-money-bill-wave-alt"></i>
									</div>
								</div>
								<div class="col-md-8">
									<h6 class="text-muted font-semibold">Total Deposit</h6>
									<h6 class="font-extrabold mb-0">$<?= $allDeposit->invested; ?></h6>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="card">
						<div class="card-body px-3 py-4-5">
							<div class="row">
								<div class="col-md-4">
									<div class="stats-icon green">
										<i class="iconly-boldAdd-User"></i>
									</div>
								</div>
								<div class="col-md-8">
									<h6 class="text-muted font-semibold">Total Withdrawal</h6>
									<h6 class="font-extrabold mb-0">$<?= $allWithdrawal->withdrawal ?></h6>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pending Account</h4>
                </div>
                <div class="card-body table-responsive-xl">

                <table id="data_table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Country</th>
																<th>View Receipt</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; foreach($pendingAcct as $row): $i++ ?>
                                <tr>
                                    <th scope="row">
                                        <?= $i ?>
                                    </th>
                                    <td><?= $row->firstname ?> <?= $row->lastname ?></td>
                                    <td> <?= $row->email ?> </td>
                                    <td> <?= $row->country ?> </td>
																		<td>
												                <a href="<?= $row->document ?>" target="_blank">
												                    <button type="button" class="btn btn-primary btn-sm">View Payment Receipt</button>
												                </a>
												            </td>
                                    <td><?= $row->updated_at ?></td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm" id="accept" onclick="approveAcct('<?= $row->uuid ?>')">Accept</button>
                                        <button type="button" class="btn btn-danger btn-sm" data-userId="<?= $row->uuid ?>" onclick="declineAcct('<?= $row->uuid ?>')" id="decline">Decline</button>
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
			<div class="card">
                <div class="card-header">
                    <h4 class="card-title">Transaction Overview</h4>
                </div>
                    <div class="card-body table-responsive-xl">
                    <table id="data_table2" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Transaction Type</th>
                            <th>Amount</th>
                            <th>Payment Method</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($usersTrans == null || ""):  ?>
							<tr>
                            <td class="mt-3 mb-3">No record avaliable</td>
							</tr>
                        <?php endif; ?>
                        <?php $i = 0; foreach($usersTrans as $row): $i++ ?>
                        <tr>
                            <td class="text-truncate"><?= $row->email ?></td>
                            <td class="text-truncate"><?= $row->type ?></td>
                            <td class="text-truncate">$ <?= $row->amount ?></td>
                            <td class="text-truncate"><?= $row->method ?></td>
                            <td class="text-truncate"><?= $row->status ?></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Email</th>
                            <th>Transaction Type</th>
                            <th>Amount</th>
                            <th>Payment Method</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>

                    </table>
                    </div>

                </div>
            </div>



		</div>

	</section>
</div>

<script>


            function approveAcct(userId){
                // var userId = $(this).attr('data-userId');
                var url = '<?= base_url('admin/approveUser') ?>'
                // console.log(userId);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "User account verification will be verified!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, verify it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                        type: 'POST',
                        url: url,
                        data: {userId},
                        success: function(data) {
                            Swal.fire(
                            'Deleted!',
                            'User account verification has been verified.',
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
            function declineAcct(userId){
                // var userId = $(this).attr('data-userId');
                var url = '<?= base_url('admin/declineUser') ?>'
                // console.log(userId);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "User verification will be declined!",
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
                        data: {userId},
                        success: function(data) {
                            Swal.fire(
                            'Deleted!',
                            'User account verification has been declined.',
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
