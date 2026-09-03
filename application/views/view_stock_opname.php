<title>PT HANDAL SUKSES KARYA</title>
<!-- Main content -->
<section class="content">
	<div class="box">
		<div class="box-header">
			<i class="fa fa-clipboard"></i>
			<h3 class="box-title">Stock Opname By Excel</h3>
		</div>
		<div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div>
		<div class="box-body">
			<div class="body table-responsive">
				<form method="post" action="<?php echo base_url('controller_monitoring/import_stock_opname'); ?>" enctype="multipart/form-data">
					<div class="form-group">
						<div class="form-line">
							<input type="file" name="upload_excel" class="form-control" placeholder="masukkan file excel" required>
						</div>
					</div>
					<button type="button" class="btn btn-warning" style="margin-left:5px" onclick="javascript:history.go(-1)">
                       	<i class="fa fa-remove"> Cancel</i>
                   	</button>
					<button type='submit' class='btn btn-info' name='import' style='margin-left:5px'>
						<i class='fa fa-upload'> Import</i>
					</button>
					<button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#ModalReset">
                       	<i class="fa fa-recycle"> Reset Stock</i>
                   	</button>
				</form>
				
				<!-- modal reset stock -->
				<form id="add-row-form" action="<?php echo base_url().'controller_monitoring/resets'?>" method="post">
					<div class="modal fade" id="ModalReset" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h2 class="modal-title" align="center" id="myModalLabel">Reset Stock</h2>
								</div>
								<div class="modal-body">
									<strong>Anda yakin mau mereset stock di sistem?</strong>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-warning" data-dismiss="modal">
										<i class="fa fa-remove"> Close</i>
									</button>
									<button type="submit" class="btn btn-danger" id="add-row">
										<i class="fa fa-check"> Reset</i>
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<script>
				$(function () {
					$('#example1').DataTable()
					$('#example2').DataTable({
						'paging'      : true,
						'lengthChange': false,
						'searching'   : false,
						'ordering'    : true,
						'info'        : true,
						'autoWidth'   : false
					})
				})
			</script>
		</div>
	</div>
</section>