<title>PT HANDAL SUKSES KARYA</title>
	<?php $array_hari=array(1=>'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');$hari=$array_hari[date('N')];?>
	<?php $hari1=date('Y-m-d') ?>
	<?php $jam=date('G:i:s') ?>
<section class="content">
	<div class="box">
		<div class="box-header">
			<i class="fa fa-bars"></i>
			<h3 class="box-title">List</h3>
		</div>
		<div class="box-body">
			<div class="row">
			<div class="col-md-4">
			<div class="header">
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalAdd">
                    <i class="fa fa-plus"> Add Model</i>
                </button>
			</div>
			<br/>
			<div id="notifications"><?php echo $this->session->flashdata('msg_model'); ?></div>
			<div class="body table-responsive">
				<div class="table-wrapper-scroll-y">                          
					<table class="table table-bordered table-fixed" id="mytable7">
						<thead>
							<tr class="bg-light-blue">
								<th>MODEL CODE</th>
								<th>MODEL</th>
								<th width="140">ACTION</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
			
			<!-- modal add model -->
			<form id="add-row-form" action="<?php echo base_url().'controller_monitoring/save_model'?>" method="post">
				<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-md">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h2 class="modal-title" align="center" id="myModalLabel">Add Model</h2>
							</div>
							<div class="modal-body">
								<div class="col-md-12">
									<div class="form-group">
										<label for="model_code">Model Code:</label>
										<input type="text" name="model_code" class="form-control" placeholder="Enter Model Code" maxlength="3" onkeyup="this.value=this.value.toUpperCase()" required>
									</div>
									<div class="form-group">
										<label for="model">Model:</label>
										<input type="text" name="model" class="form-control" placeholder="Enter Model" maxlength="35" onkeyup="this.value=this.value.toUpperCase()" required>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">
                        			<i class="fa fa-remove"> Close</i>
                    			</button>
                    			<button type="submit" class="btn btn-success" id="add-row">
                       				<i class="fa fa-check"> Save</i>
								</button>
							</div>
						</div>
					</div>
				</div>
			</form>
				
			<!-- modal edit model -->
			<form id="add-row-form" action="<?php echo base_url().'controller_monitoring/edit_model'?>" method="post">
				<div class="modal fade" id="ModalUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-md">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h2 class="modal-title" align="center" id="myModalLabel">Edit Barcode</h2>
							</div>
							<div class="modal-body">
								<div class="col-md-12">
									<div class="form-group">
										<label for="model_code">Model Code:</label>
										<input type="text" name="model_code_edit" class="form-control" placeholder="Model Code" maxlength="3" onkeyup="this.value=this.value.toUpperCase()" readonly required>
									</div>
									<div class="form-group">
										<label for="model">Model:</label>
										<input type="text" name="model_edit" class="form-control" placeholder="Model" maxlength="35" onkeyup="this.value=this.value.toUpperCase()" required>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">
                        			<i class="fa fa-remove"> Close</i>
                    			</button>
                   				<button type="submit" class="btn btn-success" id="add-row">
                       				<i class="fa fa-check"> Save</i>
                   				</button>
							</div>
						</div>
					</div>
				</div>
			</form>
				
			<!-- modal delete model -->
			<form id="add-row-form" action="<?php echo base_url().'controller_monitoring/delete_model'?>" method="post">
				<div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h2 class="modal-title" align="center" id="myModalLabel">Delete Model</h2>
							</div>
							<div class="modal-body">
								<input type="hidden" name="model_code" class="form-control" placeholder="Model Code" required>
								<strong>Anda yakin mau menghapus model ini?</strong>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">
                        			<i class="fa fa-remove"> Close</i>
                    			</button>
                   				<button type="submit" class="btn btn-success" id="add-row">
                       				<i class="fa fa-check"> Delete</i>
                   				</button>
							</div>
						</div>
					</div>
				</div>
			</form>	
			</div>
			<div class="col-md-4">
			<div class="header">
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalAdd">
                    <i class="fa fa-plus"> Add Size</i>
                </button>
			</div>
			<br/>
			<div id="notifications"><?php echo $this->session->flashdata('msg_size'); ?></div>
			<div class="body table-responsive">
				<div class="table-wrapper-scroll-y">                          
					<table class="table table-bordered table-fixed" >
						<thead>
							<tr class="bg-light-blue">
								<th>MODEL SIZE</th>
								<th>MODEL</th>
								<th width="140">ACTION</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
			</div>
			<div class="col-md-4">
			<div class="header">
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalAdd">
                    <i class="fa fa-plus"> Add Production</i>
                </button>
			</div>
			<br/>
			<div id="notifications"><?php echo $this->session->flashdata('msg_production'); ?></div>
			<div class="body table-responsive">
				<div class="table-wrapper-scroll-y">                          
					<table class="table table-bordered table-fixed" >
						<thead>
							<tr class="bg-light-blue">
								<th>MODEL PRODUCTION</th>
								<th>MODEL</th>
								<th width="140">ACTION</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
			</div>
		</div>
		</div>
	</div>
</section>