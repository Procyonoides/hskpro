<title>PT HANDAL SUKSES KARYA</title>
	<?php $array_hari=array(1=>'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');$hari=$array_hari[date('N')];?>
	<?php $hari1=date('Y-m-d') ?>
	<?php $jam=date('G:i:s') ?>
<!-- Main content -->
<section class="content">
	<div class="box">
		<div class="box-header">
			<i class="fa fa-bar-chart"></i>
			<h3 class="box-title">Transaction</h3>
		</div>
		<div class="box-body">
			<div class="header">
				<a href="<?php echo site_url()."controller_monitoring/print_transaction"?>">
				<button type="button" class="btn btn-default pull-right">
                    <i class="fa fa-print"> Print Transaction</i>
                </button>
                </a>
			</div>
			<br/>
			<br/>
			<div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div>
			<div class="body table-responsive">
				<div class="table-wrapper-scroll-y">                          
					<table class="table table-bordered table-fixed" id="mytable5">
						<thead>
							<tr class="bg-light-blue">
								<th>DATE/TIME</th>
								<th>FIRST STOCK</th>
								<th>RECEIVING</th>
								<th>SHIPPING</th>
								<th>WAREHOUSE STOCK</th>
								<th width="140">ACTION</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
				
			<!-- modal edit transaction -->
			<form id="add-row-form" action="<?php echo base_url().'controller_monitoring/edit_transaction'?>" method="post">
				<div class="modal fade" id="ModalUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h2 class="modal-title" align="center" id="myModalLabel">Edit Transaction</h2>
							</div>
							<div class="modal-body">
								<div class="col-md-6">
									<div class="form-group">
										<label for="no">No:</label>
										<input type="text" name="no_edit" class="form-control" placeholder="No" maxlength="15" readonly required>
									</div>
									<div class="form-group">
										<label for="tanggal">Tanggal:</label>
										<input type="text" name="tanggal_edit" class="form-control" placeholder="Tanggal" maxlength="15" readonly required>
									</div>				 
									<div class="form-group">
										<label for="stock_awal">Stock Awal:</label>
										<input type="text" name="awal_edit" class="form-control" placeholder="Stock Awal" maxlength="15" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="receiving">Receiving:</label>
										<input type="text" name="receiving_edit" class="form-control" placeholder="Receiving" maxlength="15" required>
									</div>
									<div class="form-group">
										<label for="shipping">Shipping:</label>
										<input type="text" name="shipping_edit" class="form-control" placeholder="Shipping" maxlength="15" required>
									</div>				 
									<div class="form-group">
										<label for="stock_akhir">Stock Akhir:</label>
										<input type="text" name="akhir_edit" class="form-control" placeholder="Stock Akhir" maxlength="15" required>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-warning" data-dismiss="modal">
                        			<i class="fa fa-remove"> Close</i>
                    			</button>
                   				<button type="submit" class="btn btn-info" id="add-row">
                       				<i class="fa fa-pencil"> Edit</i>
                   				</button>
							</div>
						</div>
					</div>
				</div>
			</form>
				
			<!-- modal delete transaction -->
			<form id="add-row-form" action="<?php echo base_url().'controller_monitoring/delete_transaction'?>" method="post">
				<div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h2 class="modal-title" align="center" id="myModalLabel">Delete Transaction</h2>
							</div>
							<div class="modal-body">
								<input type="hidden" name="no" class="form-control" placeholder="No" required>
								<strong>Anda yakin mau menghapus transaksi ini?</strong>
							</div>
							<div class="modal-footer">			
								<button type="button" class="btn btn-warning" data-dismiss="modal">
                        			<i class="fa fa-remove"> Close</i>
                    			</button>
                   				<button type="submit" class="btn btn-danger" id="add-row">
                       				<i class="fa fa-trash-o"> Delete</i>
                   				</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>