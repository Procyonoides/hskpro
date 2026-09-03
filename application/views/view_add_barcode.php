<title>PT HANDAL SUKSES KARYA</title>
<!-- Main content -->
<section class="content">
	<div class="box">
		<div class="box-header">
			<i class="fa fa-file-excel-o"></i>
			<h3 class="box-title">Add Barcode By Excel</h3>
		</div>
		<div class="box-body">
			<div class="body table-responsive">
				<form method="post" action="<?php echo base_url('controller_monitoring/import_add_barcode'); ?>" enctype="multipart/form-data">
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