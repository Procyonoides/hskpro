<meta http-equiv="refresh" content="10"/>
<title>PT HANDAL SUKSES KARYA</title>
<section class="content-header">
	<h1>
		Stock Monitoring
	</h1>
</section>

<!-- Main content -->
<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">
        <div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-aqua">
				<div class="inner">
					<span class="info-box-number" style="font-size:40px" data-counter="<?php
						$nol = '0';
						if ($stock_awal == '') {
							echo $nol;
						} else {
							echo $stock_awal; 
						}?>">0
					</span>
					<h4>First Stock</h4>
				</div>
				<div class="icon">
					<i class="ion ion-cube"></i>
				</div>
			</div>
        </div>
        <!-- /.col -->
		
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-green">
				<div class="inner">
					<span class="info-box-number" style="font-size:40px" data-counter="<?php
						$nol = '0';
						if ($receiving == '') {
							echo $nol;
						} else {
							echo $receiving; 
						}?>">0
					</span>
					<h4>Receiving</h4>
				</div>
				<div class="icon">
					<i class="ion ion-arrow-down-c"></i>
				</div>
			</div>
        </div>
        <!-- ./col -->
		
        <div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-yellow">
				<div class="inner">
					<span class="info-box-number" style="font-size:40px" data-counter="<?php
						$nol = '0';
						if ($shipping == '') {
							echo $nol;
						} else {
							echo $shipping; 
						}?>">0
					</span>
					<h4>Shipping</h4>
				</div>
				<div class="icon">
					<i class="ion ion-arrow-up-c"></i>
				</div>
			</div>
        </div>
		<!-- ./col -->
		
        <div class="col-lg-3 col-xs-6">
          	<!-- small box -->
			<div class="small-box bg-red">
				<div class="inner">
					<span class="info-box-number" style="font-size:40px" data-counter="<?php
						$nol = '0';
						if ($stock_akhir == '') {
							echo $nol;
						} else {
							echo $stock_akhir; 
						}?>">0
					</span>
					<h4>Warehouse Stock</h4>
				</div>
				<div class="icon">
					<i class="ion ion-cube"></i>
				</div>
			</div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
	
	<!-- Small boxes (Stat box) -->
	<div class="row">
        <div class="col-md-5 col-sm-5 col-xs-12">
			<!-- small box -->
			<div class="box">
				<div class="box-header">
					<i class="fa fa-area-chart"></i>
					<h3 class="box-title">Chart Daily</h3>
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<div class="box-body" style="position:relative;height:630px;">
					<div class="chart">
						<canvas id="canvas_daily" style="height:610px;"></canvas>
					</div>
				</div>
			</div>
        </div>
        <!-- /.col -->
		
		<div class="col-md-4 col-sm-4 col-xs-12">
			<!-- small box -->
			<div class="box">
				<div class="box-header">
					<i class="fa fa-area-chart"></i>
					<h3 class="box-title">Scan by Shift on <?php echo $kemarin; ?></h3>
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<div class="box-body" style="position:relative;height:630px;">
					<table id="example2" class="table table-bordered table-hover">
						<thead>
							<th style="width:10px">NO</th>
							<th>SHIFT</th>
							<th>STATUS</th>
							<th>PERCENT</th>
							<th style="width:10px">TOTAL</th>
						</thead>
						<tbody>
							<?php $no=1; 
								foreach($detail_shift as $data) { ?>
							<tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo $data->username; ?></td>
								<?php if ($data->status > "25") { ?>
								<td>
									<div class="progress progress-sm">
										<div class="progress-bar progress-bar-danger" style="width:<?php echo $data->status; ?>%"></div>
									</div>
								</td>
								<?php } else if ($data->status >= "10" and $data->status <= "25") { ?>
								<td>
									<div class="progress progress-sm">
										<div class="progress-bar progress-bar-yellow" style="width:<?php echo $data->status; ?>%"></div>
									</div>
								</td>
								<?php } else if ($data->status >= "5" and $data->status <= "10") { ?>
								<td>
									<div class="progress progress-sm">
										<div class="progress-bar progress-bar-success" style="width:<?php echo $data->status; ?>%"></div>
									</div>
								</td>
								<?php } else if ($data->status >= "0" and $data->status <= "5") { ?>
								<td>
									<div class="progress progress-sm">
										<div class="progress-bar progress-bar-info" style="width:<?php echo $data->status; ?>%"></div>
									</div>
								</td>
								<?php } ?>
								<td><span class="label bg-teal"><?php echo $data->percent; ?> %</td>
								<td><span class="label bg-primary"><?php echo $data->total; ?></span></td>								
							</tr>
							<?php }	?>
						</tbody>
					</table>
				</div>
			</div>
        </div>
        <!-- /.col -->
		
        <div class="col-md-3 col-sm-3 col-xs-12">
			<!-- small box -->
			<div class="box">
				<div class="box-header">
					<i class="fa fa-area-chart"></i>
					<h3 class="box-title">Chart Warehouse</h3>
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<div class="box-body" style="position:relative;height:630px;">
					<?php 
						foreach($detail_warehouse as $data) { ?>
						<?php if ($data->item == "IP") { ?>
						<div class="info-box bg-red">
							<span class="info-box-icon"><i class="ion ion-ios-box-outline"></i></span>
							<div class="info-box-content">
								<span class="info-box-text" style="font-size:15px"><?php echo $data->item; ?></span>
								<span class="info-box-number" style="font-size:20px" data-counter="<?php echo $data->total; ?>">0</span>
								<div class="progress">
									<div class="progress-bar" style="width:<?php echo $data->status; ?>%"></div>
								</div>
								<span class="progress-description" style="font-size:12px">
									<?php echo $data->status; ?>% of Stock in Warehouse
								</span>
							</div>
						</div>
						<?php } else if ($data->item == "PHYLON") { ?>
						<div class="info-box bg-orange">
							<span class="info-box-icon"><i class="ion ion-ios-box-outline"></i></span>
							<div class="info-box-content">
								<span class="info-box-text" style="font-size:15px"><?php echo $data->item; ?></span>
								<span class="info-box-number" style="font-size:20px" data-counter="<?php echo $data->total; ?>">0</span>
								<div class="progress">
									<div class="progress-bar" style="width:<?php echo $data->status; ?>%"></div>
								</div>
								<span class="progress-description" style="font-size:12px">
									<?php echo $data->status; ?>% of Stock in Warehouse
								</span>
							</div>
						</div>
						<?php } else if ($data->item == "BLOKER") { ?>
						<div class="info-box bg-green">
							<span class="info-box-icon"><i class="ion ion-ios-box-outline"></i></span>
							<div class="info-box-content">
								<span class="info-box-text" style="font-size:15px"><?php echo $data->item; ?></span>
								<span class="info-box-number" style="font-size:20px" data-counter="<?php echo $data->total; ?>">0</span>
								<div class="progress">
									<div class="progress-bar" style="width:<?php echo $data->status; ?>%"></div>
								</div>
								<span class="progress-description" style="font-size:12px">
									<?php echo $data->status; ?>% of Stock in Warehouse
								</span>
							</div>
						</div>
						<?php } else if ($data->item == "PAINT") { ?>
						<div class="info-box bg-light-blue">
							<span class="info-box-icon"><i class="ion ion-ios-box-outline"></i></span>
							<div class="info-box-content">
								<span class="info-box-text" style="font-size:15px"><?php echo $data->item; ?></span>
								<span class="info-box-number" style="font-size:20px" data-counter="<?php echo $data->total; ?>">0</span>
								<div class="progress">
									<div class="progress-bar" style="width:<?php echo $data->status; ?>%"></div>
								</div>
								<span class="progress-description" style="font-size:12px">
									<?php echo $data->status; ?>% of Stock in Warehouse
								</span>
							</div>
						</div>
						<?php } else { ?>
						<div class="info-box bg-gray">
							<span class="info-box-icon"><i class="ion ion-ios-box-outline"></i></span>
							<div class="info-box-content">
								<span class="info-box-text" style="font-size:15px"><?php echo $data->item; ?></span>
								<span class="info-box-number" style="font-size:20px" data-counter="<?php echo $data->total; ?>">0</span>
								<div class="progress">
									<div class="progress-bar" style="width:<?php echo $data->status; ?>%"></div>
								</div>
								<span class="progress-description" style="font-size:12px">
									<?php echo $data->status; ?>% of Stock in Warehouse
								</span>
							</div>
						</div>
						<?php } ?>
					<?php }	?>
				</div>
			</div>
        </div>
        <!-- /.col -->
    </div>
	<!-- /.row -->
	
	<!-- Small boxes (Stat box) -->
	<div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
			<!-- small box -->
			<div class="box">
				<div class="box-header">
					<i class="fa fa-th-large"></i>
					<h3 class="box-title">Scan Receiving</h3>
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<div class="box-body">
					<table class="table table-condensed table-bordered">
						<thead>
							<tr class="bg-green">
								<td align="center"><label>DATE/TIME</label></td>
								<td align="center"><label>ORIGINAL BARCODE</label></td>
								<td align="center"><label>MODEL</label></td>
								<td align="center"><label>COLOR</label></td>
								<td align="center"><label>SIZE</label></td>
								<td align="center"><label>QUANTITY</label></td>
								<td align="center"><label>USERNAME</label></td>
								<td align="center"><label>SCAN NO</label></td>    
							</tr>
						</thead>
						<tbody>
						<?php foreach ($result_receiving->result() as $row) { ?>                                            
							<tr>
								<td align="center"><?php echo $row->date_time; ?></td>
								<td align="center"><?php echo $row->original_barcode; ?></td>
								<td align="center"><?php echo $row->model; ?></td>
								<td align="center"><?php echo $row->color; ?></td> 
								<td align="center"><?php echo $row->size; ?></td>
								<td align="center"><?php echo $row->quantity; ?></td>
								<td align="center"><?php echo $row->username; ?></td>
								<td align="center"><?php echo $row->scan_no; ?></td>                                       
							</tr>
						<?php } ?>                                      
						</tbody>
					</table>
				</div>
			</div>
        </div>
        <!-- /.col -->
		
        <div class="col-md-6 col-sm-6 col-xs-12">
			<!-- small box -->
			<div class="box">
				<div class="box-header">
					<i class="fa fa-th-large"></i>
					<h3 class="box-title">Scan Shipping</h3>
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<div class="box-body">
					<table class="table table-condensed table-bordered">
						<thead>
							<tr class="bg-orange">
								<td align="center"><label>DATE/TIME</label></td>
								<td align="center"><label>ORIGINAL BARCODE</label></td>
								<td align="center"><label>MODEL</label></td>
								<td align="center"><label>COLOR</label></td>
								<td align="center"><label>SIZE</label></td>
								<td align="center"><label>QUANTITY</label></td>
								<td align="center"><label>USERNAME</label></td>
								<td align="center"><label>SCAN NO</label></td>   
							</tr>
						</thead>
						<tbody style="border-color: green">
						<?php foreach ($result_shipping->result() as $row) { ?>                                         
							<tr>
								<td align="center"><?php echo $row->date_time; ?></td>
								<td align="center"><?php echo $row->original_barcode; ?></td>
								<td align="center"><?php echo $row->model; ?></td>
								<td align="center"><?php echo $row->color; ?></td> 
								<td align="center"><?php echo $row->size; ?></td>
								<td align="center"><?php echo $row->quantity; ?></td>
								<td align="center"><?php echo $row->username; ?></td>
								<td align="center"><?php echo $row->scan_no; ?></td>                                           
							</tr>
						<?php } ?>                                    
						</tbody>
					</table>
				</div>
			</div>
        </div>
        <!-- /.col -->
    </div>
	<!-- /.row -->
</section>