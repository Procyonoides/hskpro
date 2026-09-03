<title>PT HANDAL SUKSES KARYA</title>
	<?php $array_hari=array(1=>'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');$hari=$array_hari[date('N')];?>
	<?php $hari1=date('Y-m-d') ?>
	<?php $jam=date('G:i:s') ?>
<!-- Main content -->
<section class="content">
	<div class="box">
		<div class="box-header">
			<i class="fa fa-cloud"></i>
			<h3 class="box-title">Master Data</h3>
		</div>
		<div class="box-body">
			<div class="header">
				<div class="btn-group">
					<button type="button" class="btn bg-green"><i class="fa fa-plus"> Add</i></button>
					<button type="button" class="btn bg-green dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
						<span class="sr-only">Toggle Dropdown</span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li data-toggle="modal" data-target="#ModalAdd"><a href="#">Add Barcode</a></li>
						<li><a href="<?php echo base_url();?>controller_monitoring/add_barcode">Add Barcode By Excel</a></li>
					</ul>
                </div>
				<div class="btn-group">
					<button type="button" class="btn bg-teal"><i class="fa fa-sort-amount-asc"> Option</i></button>
					<button type="button" class="btn bg-teal dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
						<span class="sr-only">Toggle Dropdown</span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li><a href="<?php echo base_url();?>controller_monitoring/option_model">Option Model</a></li>
						<li><a href="<?php echo base_url();?>controller_monitoring/option_size">Option Size</a></li>
						<li><a href="<?php echo base_url();?>controller_monitoring/option_production">Option Production</a></li>
					</ul>
                </div>
				<div class="btn-group">
					<button type="button" class="btn bg-red"><i class="fa fa-gears"> Operation</i></button>
					<button type="button" class="btn bg-red dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
						<span class="sr-only">Toggle Dropdown</span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li><a href="<?php echo base_url();?>controller_monitoring/stock_opname"> Stock Opname By Excel</a></li>
						<li class="divider"></li>
						<li data-toggle="modal" data-target="#ModalRecord"><a href="#">Record</a></li>
						<li data-toggle="modal" data-target="#ModalBackup"><a href="#">Backup</a></li>
						<li data-toggle="modal" data-target="#ModalDuplicate"><a href="#">Duplicate</a></li>
					</ul>
                </div>
				<a href="<?php echo base_url();?>controller_monitoring/print_master_data">
                <button type="button" class="btn btn-default pull-right" style="margin-left:5px">
                    <i class="fa fa-print"> Print Master Data</i>
                </button>
                </a>
                <a href="<?php echo base_url();?>assets/uploads/format.xlsx">
                <button type="button" class="btn btn-default pull-right">
                    <i class="fa fa-sticky-note-o"> Format Excel</i>
                </button>
                </a>
			</div>
			<br/>
			<div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div>
			<div class="body table-responsive">
				<div class="table-wrapper-scroll-y">                          
					<table class="table table-bordered table-fixed" id="mytable">
						<thead>
							<tr class="bg-light-blue">
								<th>ORIGINAL BARCODE</th>
								<th>BRAND</th>
								<th>COLOR</th>
								<th>SIZE</th>
								<th>FOUR DIGIT</th>
								<th>UNIT</th>
								<th>QUANTITY</th>
								<th>PRODUCTION</th>
								<th>MODEL</th>
								<th>MODEL CODE</th>
								<th>ITEM</th>
								<th>USERNAME</th>
								<th>DATE/TIME</th>
								<th>STOCK</th>
								<th width="140">ACTION</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
				
			<!-- modal add barcode -->
			<form id="add-row-form" action="<?php echo base_url().'controller_monitoring/save_barcode'?>" method="post">
				<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h2 class="modal-title" align="center" id="myModalLabel">Add Barcode</h2>
							</div>
							<div class="modal-body">
								<div class="col-md-6">
									<div class="form-group">
										<label for="barcode">Original Barcode:</label>
										<input type="text" name="barcode" class="form-control" placeholder="Original Barcode" maxlength="15" onkeyup="this.value=this.value.toUpperCase()" required>
									</div>
									<div class="form-group">
										<label for="brand">Brand:</label>
										<select class="form-control" name="brand" required>
											<option value="-">-</option>
											<option value="ADIDAS">ADIDAS</option>
											<option value="NEW BALANCE">NEW BALANCE</option>
											<option value="REEBOK">REEBOK</option>
											<option value="ASICS">ASICS</option>
											<option value="SPECS">SPECS</option>
											<option value="OTHER BRAND">OTHER BRAND</option>
										</select>
									</div>
									<div class="form-group">
										<label for="color">Color:</label>
										<input type="text" name="color" class="form-control" placeholder="Color" maxlength="255" onkeyup="this.value=this.value.toUpperCase()" required>
									</div>
									<div class="form-group">
										<label for="size">Size:</label>
										<select class="form-control" name="size" required>
											<option value="-">-</option>
											<?php foreach($size as $row):?>
											<option value="<?php echo $row->size;?>"><?php echo $row->size;?></option>
											<?php endforeach;?>
										</select>
									</div>
									<div class="form-group">
										<label for="digit">Four Digit:</label>
										<input type="text" name="digit" class="form-control" placeholder="Four Digit" maxlength="4" onkeyup="this.value=this.value.toUpperCase()" readonly required>
									</div>
									<div class="form-group">
										<label for="unit">Unit:</label>
										<select class="form-control" name="unit" required>
											<option value="-">-</option>
											<option value="PRS">PRS</option>
											<option value="PCS">PCS</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="quantity">Quantity:</label>
										<input type="text" name="quantity" class="form-control" placeholder="Quantity" maxlength="7" required>
									</div>
									<div class="form-group">
										<label for="production">Production:</label>
										<select class="form-control" name="production" required>
											<option value="-">-</option>
											<?php foreach($production as $row):?>
											<option value="<?php echo $row->production;?>"><?php echo $row->production;?></option>
											<?php endforeach;?>
										</select>
									</div>				 
									<div class="form-group">
										<label for="model">Model:</label>
										<select class="form-control" name="model" required>
											<option value="-">-</option>
											<?php foreach($model as $row):?>
											<option value="<?php echo $row->model;?>"><?php echo $row->model;?></option>
											<?php endforeach;?>
										</select>
									</div>
									<div class="form-group">
										<label for="code">Model Code:</label>
										<input type="text" name="code" class="form-control" placeholder="Model Code" maxlength="3" onkeyup="this.value=this.value.toUpperCase()" readonly required>
									</div>
									<div class="form-group">
										<label for="item">Item:</label>
										<select class="form-control" name="item" required>
											<option value="-">-</option>
											<option value="IP">IP</option>
											<option value="PHYLON">PHYLON</option>
											<option value="BLOKER">BLOKER</option>
											<option value="PAINT">PAINT</option>
											<option value="RUBBER">RUBBER</option>
											<option value="GOODSOLE">GOODSOLE</option>
										</select>
									</div>
									<div class="form-group">
										<label for="stock">Stock:</label>
										<input type="text" name="stock" class="form-control" placeholder="Stock" maxlength="7" value="0" readonly required>
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
				
			<!-- modal edit barcode -->
			<form id="add-row-form" action="<?php echo base_url().'controller_monitoring/edit_barcode'?>" method="post">
				<div class="modal fade" id="ModalUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h2 class="modal-title" align="center" id="myModalLabel">Edit Barcode</h2>
							</div>
							<div class="modal-body">
								<div class="col-md-6">
									<div class="form-group">
										<label for="barcode">Original Barcode:</label>
										<input type="text" name="barcode_edit" class="form-control" placeholder="Original Barcode" maxlength="15" readonly required>
									</div>
									<div class="form-group">
										<label for="brand">Brand:</label>
										<select class="form-control" name="brand_edit" required>
											<option value="-">-</option>
											<option value="ADIDAS">ADIDAS</option>
											<option value="NEW BALANCE">NEW BALANCE</option>
											<option value="REEBOK">REEBOK</option>
											<option value="ASICS">ASICS</option>
											<option value="SPECS">SPECS</option>
										</select>
									</div>
									<div class="form-group">
										<label for="color">Color:</label>
										<input type="text" name="color_edit" class="form-control" placeholder="Color" maxlength="255" onkeyup="this.value=this.value.toUpperCase()" required>
									</div>
									<div class="form-group">
										<label for="size">Size:</label>
										<select class="form-control" name="size_edit" required>
											<option value="-">-</option>
											<?php foreach($size as $row):?>
											<option value="<?php echo $row->size;?>"><?php echo $row->size;?></option>
											<?php endforeach;?>
										</select>
									</div>
									<div class="form-group">
										<label for="digit">Four Digit:</label>
										<input type="text" name="digit_edit" class="form-control" placeholder="Four Digit" maxlength="4" onkeyup="this.value=this.value.toUpperCase()" readonly required>
									</div>				 
									<div class="form-group">
										<label for="unit">Unit:</label>
										<select class="form-control" name="unit_edit" required>
											<option value="-">-</option>
											<option value="PRS">PRS</option>
											<option value="PCS">PCS</option>
										</select>
									</div>
									<div class="form-group">
										<label for="quantity">Quantity:</label>
										<input type="text" name="quantity_edit" class="form-control" placeholder="Quantity" maxlength="7" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="production">Production:</label>
										<select class="form-control" name="production_edit" required>
											<option value="-">-</option>
											<?php foreach($production as $row):?>
											<option value="<?php echo $row->production;?>"><?php echo $row->production;?></option>
											<?php endforeach;?>
										</select>
									</div>				 
									<div class="form-group">
										<label for="model">Model:</label>
										<select class="form-control" name="model_edit" required>
											<option value="-">-</option>
											<?php foreach($model as $row):?>
											<option value="<?php echo $row->model;?>"><?php echo $row->model;?></option>
											<?php endforeach;?>
										</select>
									</div>
									<div class="form-group">
										<label for="code">Model Code:</label>
										<input type="text" name="code_edit" class="form-control" placeholder="Model Code" maxlength="3" onkeyup="this.value=this.value.toUpperCase()" readonly required>
									</div>
									<div class="form-group">
										<label for="item">Item:</label>
										<select class="form-control" name="item_edit" required>
											<option value="-">-</option>
											<option value="IP">IP</option>
											<option value="PHYLON">PHYLON</option>
											<option value="BLOKER">BLOKER</option>
											<option value="PAINT">PAINT</option>
											<option value="RUBBER">RUBBER</option>
											<option value="GOODSOLE">GOODSOLE</option>
										</select>
									</div>
									<div class="form-group">
										<label for="username">Username:</label>
										<input type="text" name="username_edit" class="form-control" placeholder="Username" maxlength="10" readonly required>
									</div>
									<div class="form-group">
										<label for="date">Date Time:</label>
										<input type="text" name="date_edit" class="form-control" placeholder="Date" maxlength="10" readonly required>
									</div>				 
									<div class="form-group">
										<label for="stock">Stock:</label>
										<input type="text" name="stock_edit" class="form-control" placeholder="Stock" maxlength="7" required>
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
				
			<!-- modal delete barcode -->
			<form id="add-row-form" action="<?php echo base_url().'controller_monitoring/delete_barcode'?>" method="post">
				<div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h2 class="modal-title" align="center" id="myModalLabel">Delete Barcode</h2>
							</div>
							<div class="modal-body">
								<input type="hidden" name="barcode" class="form-control" placeholder="Original Barcode" required>
								<strong>Anda yakin mau menghapus barcode ini?</strong>
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
			
			<!-- modal record -->
			<form id="add-row-form" action="<?php echo base_url().'controller_monitoring/record'?>" method="post">
				<div class="modal fade" id="ModalRecord" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-xl">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h2 class="modal-title" align="center" id="myModalLabel">Record</h2>
							</div>
							<div class="row" style="padding:25px">
								<div class="col-md-6">
									<div class="form-group">
										<select class="form-control" name="tipe" required>
											<option value="" disable selected>Select Transaction</option>
											<option value="receiving">RECEIVING</option>
											<option value="shipping">SHIPPING</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">									
									<div class="form-group">
										<input type="text" id="reservation" name="tanggal" min="2018-01-01" max="2050-12-31">
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-warning" data-dismiss="modal">
                        			<i class="fa fa-remove"> Close</i>
                    			</button>
								<button type="submit" class="btn btn-success" id="add-row">
									<i class="fa fa-check"> Submit</i>
								</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			
			<!-- modal backup -->
			<form id="add-row-form" action="<?php echo base_url().'controller_monitoring/backup'?>" method="post">
				<div class="modal fade" id="ModalBackup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-xl">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h2 class="modal-title" align="center" id="myModalLabel">Backup</h2>
							</div>
							<div class="row" style="padding:25px">
								<div class="col-md-12">
									<div class="form-group">
										<select class="form-control" name="tipe" required>
											<option value="" disable selected>Select Transaction</option>
											<option value="receiving">RECEIVING</option>
											<option value="shipping">SHIPPING</option>
										</select>
									</div>			 
								</div>								
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-warning" data-dismiss="modal">
                        			<i class="fa fa-remove"> Close</i>
                    			</button>
								<button type="submit" class="btn btn-success" id="add-row">
									<i class="fa fa-check"> Submit</i>
								</button>
							</div>
							<div class="callout callout-danger">
							<h4>Attention</h4>
								<p>You Can Backup Data on 2nd of January</p>
							</div>
						</div>
					</div>
				</div>
			</form>
			
			<!-- modal duplicate -->
			<form id="add-row-form" action="<?php echo base_url().'controller_monitoring/duplicate'?>" method="post">
				<div class="modal fade" id="ModalDuplicate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-xl">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h2 class="modal-title" align="center" id="myModalLabel">Duplicate</h2>
							</div>
							<div class="row" style="padding:25px">
								<div class="col-md-6">
									<div class="form-group">
										<select class="form-control" name="tipe" required>
											<option value="" disable selected>Select Transaction</option>
											<option value="receiving">RECEIVING</option>
											<option value="shipping">SHIPPING</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">									
									<div class="form-group">
										<input type="text" id="reservation1" name="tanggal" min="2018-01-01" max="2050-12-31">
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-warning" data-dismiss="modal">
                        			<i class="fa fa-remove"> Close</i>
                    			</button>
								<button type="submit" class="btn btn-success" id="add-row">
									<i class="fa fa-check"> Submit</i>
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