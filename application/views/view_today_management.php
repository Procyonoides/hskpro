<title>PT HANDAL SUKSES KARYA</title>
	<?php $array_day=array(1=>'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');$day=$array_day[date('N')];?>
	<?php $tanggal=date('Y-m-d') ?>
	<?php $jam=date('G:i:s') ?>
	<?php $input=date('m/d/Y') ?>
<!-- Main content -->
<section class="content">
	<div class="box">
		<div class="box-header">
			<i class="fa fa-file-text"></i>
			<h3 class="box-title">Today Report</h3>
		</div>
		<div class="box-body">
			<div class="header">
				<form class="form-inline" action="today_management" method="post" align="center">
					<div class="form-group">
						<select class="form-control" name="tipe" required>
							<option value="" disable selected>Select Transaction</option>
							<option value="receiving">RECEIVING</option>
							<option value="shipping">SHIPPING</option>
						</select>
					</div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					<div class="form-group">
						<div class="input-group date">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input type="text" class="form-control pull-right" value="<?php echo $input?>" readonly>
						</div>
					</div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					<div class="form-group">
						<button type="submit" name="btnSubmit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Filter</button>
					</div>
				</form>       		
			</div>
			<div>
				<table class="table table-bordered table-striped">
					<?php if($tipe==null){
							$tipe='n';
						}else{
							$tipe=$tipe;
						}
					?>
					<br/>
					<a href="<?php echo site_url()."controller_monitoring/print_summary_it/$tipe/$tanggal/$jam"?>">
						<button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print Summary</button>
					</a>
					<a href="<?php echo site_url()."controller_monitoring/print_detail/$tipe/$tanggal/$jam"?>">
						<button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print Detail</button>
					</a>
                </a>
				</table>
			</div>
			<div>
				<div>                          
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr class="bg-light-blue">
								<th>DATE/TIME</th>
								<th>PRODUCTION</th>
								<th>BRAND</th>
								<th>MODEL</th>
								<th>COLOR</th>
								<th>SIZE</th>
								<th>QUANTITY</th>
								<th>USERNAME</th>
								<th>DESCRIPTION</th>
								<th>SCAN NO</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($detail as $data){?>
							<tr>
								<td align="center"><?php echo $data->date_time ?></td>
								<td align="center"><?php echo $data->production ?></td>
								<td align="center"><?php echo $data->brand ?></td>	
								<td align="center"><?php echo $data->model ?></td>	
								<td align="center"><?php echo $data->color ?></td>	
								<td align="center"><?php echo $data->size ?></td>	
								<td align="center"><?php echo $data->quantity ?></td>		
								<td align="center"><?php echo $data->username ?></td>
								<td align="center"><?php echo $data->description ?></td>								
								<td align="center"><?php echo $data->scan_no ?></td>		
							</tr>
							<?php }	?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>