<title>PT HANDAL SUKSES KARYA</title>
	<?php $array_hari=array(1=>'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');$hari=$array_hari[date('N')];?>
	<?php $hari1=date('Y-m-d') ?>
	<?php $jam=date('G:i:s') ?>
<!-- Main content -->
<section class="content">
	<div class="box">
		<div class="box-header">
			<i class="fa fa-folder"></i>
			<h3 class="box-title">Record</h3>
		</div>
		<div class="box-body">
			<div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div>
			<div class="body table-responsive">
				<div class="table-wrapper-scroll-y">                          
					<table class="table table-bordered table-fixed" id="mytable10">
						<thead>
							<tr class="bg-light-blue">
								<th>DATE/TIME</th>
								<th>ORIGINAL BARCODE</th>
								<th>BRAND</th>
								<th>MODEL</th>
								<th>COLOR</th>
								<th>SIZE</th>
								<th>QUANTITY</th>
								<th>USERNAME</th>
								<th>DESCRIPTION</th>
								<th>SCAN NO</th>
								<th width="140">ACTION</th>
							</tr>
						</thead>
					</table>
				</div>
			</div><br/><br/>
			<a href="<?php echo base_url();?>controller_monitoring/master">
			<button type="button" class="btn btn-warning pull-right" onclick="javascript:history.go(-1)">
                <i class="fa fa-remove"> Close</i>
            </button>
			</a>
			
			<!-- modal edit record -->
			<form id="add-row-form" action="<?php echo base_url().'controller_monitoring/edit_record'?>" method="post">
				<div class="modal fade" id="ModalUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h2 class="modal-title" align="center" id="myModalLabel">Edit Record</h2>
							</div>
							<div class="modal-body">
								<div class="col-md-6">
									<div class="form-group">
										<label for="barcode">Original Barcode:</label>
										<input type="text" name="barcode_edit" id="barcode" class="form-control" placeholder="Original Barcode" maxlength="15" onkeyup="this.value=this.value.toUpperCase()" required>
									</div>
									<div class="form-group">
										<label for="brand">Brand:</label>
										<input type="text" name="brand_edit" class="form-control" placeholder="Brand" maxlength="11" readonly required>
									</div>
									<div class="form-group">
										<label for="color">Color:</label>
										<input type="text" name="color_edit" class="form-control" placeholder="Color" maxlength="255" readonly required>
									</div>
									<div class="form-group">
										<label for="size">Size:</label>
										<input type="text" name="size_edit" class="form-control" placeholder="Size" maxlength="15" readonly required>
									</div>
									<div class="form-group">
										<label for="digit">Four Digit:</label>
										<input type="text" name="digit_edit" class="form-control" placeholder="Four Digit" maxlength="4" readonly required>
									</div>				 
									<div class="form-group">
										<label for="unit">Unit:</label>
										<input type="text" name="unit_edit" class="form-control" placeholder="Unit" maxlength="3" readonly required>
									</div>
									<div class="form-group">
										<label for="quantity">Quantity:</label>
										<input type="text" name="quantity_edit" class="form-control" placeholder="Quantity" maxlength="7" readonly required>
									</div>
								</div>
								<div class="col-md-6">	
									<div class="form-group">
										<label for="production">Production:</label>
										<input type="text" name="production_edit" class="form-control" placeholder="Production" maxlength="30" readonly required>
									</div>
									<div class="form-group">
										<label for="model">Model:</label>
										<input type="text" name="model_edit" class="form-control" placeholder="Model" maxlength="255" readonly required>
									</div>
									<div class="form-group">
										<label for="code">Model Code:</label>
										<input type="text" name="code_edit" class="form-control" placeholder="Model Code" maxlength="3" readonly required>
									</div>
									<div class="form-group">
										<label for="item">Item:</label>
										<input type="text" name="item_edit" class="form-control" placeholder="Item" maxlength="10" readonly required>
									</div>	
									<div class="form-group">
										<label for="date">Date Time:</label>
										<input type="text" name="date_edit" class="form-control" placeholder="Date" maxlength="10" readonly required>
									</div>
									<div class="form-group">
										<label for="scan">Scan No:</label>
										<input type="text" name="scan_edit" class="form-control" placeholder="Scan No" maxlength="6" readonly required>
									</div>
									<div class="form-group">
										<label for="username">Username:</label>
										<select class="form-control" name="username_edit" required>
											<option value="-">-</option>
											<?php foreach($usernames as $row):?>
											<option value="<?php echo $row->username;?>"><?php echo $row->username;?></option>
											<?php endforeach;?>
										</select>
										<input type="hidden" name="user" class="form-control" placeholder="Username" maxlength="25" readonly required>
									</div>
									<div class="form-group">
										<input type="hidden" name="description_edit" class="form-control" placeholder="Description" maxlength="25" onkeyup="this.value=this.value.toUpperCase()" readonly required>
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
				
			<!-- modal delete record -->
			<form id="add-row-form" action="<?php echo base_url().'controller_monitoring/delete_record'?>" method="post">
				<div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h2 class="modal-title" align="center" id="myModalLabel">Delete Record</h2>
							</div>
							<div class="modal-body">
								<input type="hidden" name="date" class="form-control" placeholder="Original Barcode" required>
								<input type="hidden" name="scan" class="form-control" placeholder="Scan No" required>
								<input type="hidden" name="user" class="form-control" placeholder="Username" required>
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
<script type="text/javascript">
	function protectinput(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		return true;
	}
</script>