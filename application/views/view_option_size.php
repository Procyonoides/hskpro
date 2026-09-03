<title>PT HANDAL SUKSES KARYA</title>
	<?php $array_hari=array(1=>'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');$hari=$array_hari[date('N')];?>
	<?php $hari1=date('Y-m-d') ?>
	<?php $jam=date('G:i:s') ?>
<!-- Main content -->	
<section class="content">
	<div class="box">
		<div class="box-header">
			<i class="fa fa-sort-amount-asc"></i>
			<h3 class="box-title">Option Size</h3>
		</div>
		<div class="box-body">
			<div class="header">
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalAdd">
                    <i class="fa fa-plus"> Add Size</i>
                </button>
			</div>
			<br/>
			<div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div>
			<div class="body table-responsive">
				<div class="table-wrapper-scroll-y">                          
					<table class="table table-bordered table-fixed" id="mytable8">
						<thead>
							<tr class="bg-light-blue">
								<th>SIZE CODE</th>
								<th>SIZE</th>
								<th width="140">ACTION</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
			
			<!-- modal add size -->
			<form id="add-row-form" action="<?php echo base_url().'controller_monitoring/save_size'?>" method="post">
				<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-md">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h2 class="modal-title" align="center" id="myModalLabel">Add Size</h2>
							</div>
							<div class="modal-body">
								<div class="col-md-12">
									<div class="form-group">
										<label for="size_code">Size Code:</label>
										<input type="text" name="size_code" class="form-control" placeholder="Enter Size Code" maxlength="4" onkeyup="this.value=this.value.toUpperCase()" required>
									</div>
									<div class="form-group">
										<label for="size">Size:</label>
										<input type="text" name="size" class="form-control" placeholder="Enter Size" maxlength="4" onkeyup="this.value=this.value.toUpperCase()" required>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-warning" data-dismiss="modal">
                        			<i class="fa fa-remove"> Close</i>
                    			</button>
                    			<button type="submit" class="btn btn-success" id="add-row">
                       				<i class="fa fa-plus"> Add</i>
								</button>
							</div>
						</div>
					</div>
				</div>
			</form>
				
			<!-- modal edit size -->
			<form id="add-row-form" action="<?php echo base_url().'controller_monitoring/edit_size'?>" method="post">
				<div class="modal fade" id="ModalUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-md">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h2 class="modal-title" align="center" id="myModalLabel">Edit Size</h2>
							</div>
							<div class="modal-body">
								<div class="col-md-12">
									<div class="form-group">
										<label for="size_code">Size Code:</label>
										<input type="text" name="size_code_edit" class="form-control" placeholder="Size Code" maxlength="4" onkeyup="this.value=this.value.toUpperCase()" readonly required>
									</div>
									<div class="form-group">
										<label for="size">Size:</label>
										<input type="text" name="size_edit" class="form-control" placeholder="Size" maxlength="4" onkeyup="this.value=this.value.toUpperCase()" required>
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
				
			<!-- modal delete size -->
			<form id="add-row-form" action="<?php echo base_url().'controller_monitoring/delete_size'?>" method="post">
				<div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h2 class="modal-title" align="center" id="myModalLabel">Delete Size</h2>
							</div>
							<div class="modal-body">
								<input type="hidden" name="size_code" class="form-control" placeholder="Size Code" required>
								<strong>Anda yakin mau menghapus size ini?</strong>
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