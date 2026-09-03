<title>PT HANDAL SUKSES KARYA</title>
	<?php $array_day=array(1=>'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');$day=$array_day[date('N')];?>
	<?php $tanggal=date('Y-m-d') ?>
<!-- Main content -->
<section class="content">
	<div class="box">
		<div class="box-header">
			<i class="fa fa-file-text"></i>
			<h3 class="box-title">Monthly Report</h3>
		</div>
		<div class="box-body">
			<div class="header">
				<form class="form-inline" action="monthly_management" method="post" align="center">
					<div class="form-group">
						<select class="form-control" name="tipe" required>
							<option value="" disable selected>Select Transaction</option>
							<option value="receiving">RECEIVING</option>
							<option value="shipping">SHIPPING</option>
						</select>
					</div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					<div class="form-group">
						<select class="form-control" name="model">
							<option value="" disable selected>Select Models</option>
							<?php 
							foreach($models as $data){
								$conv=str_replace(" ", "_", $data);
								echo "<option value=".$conv['model_code'].">".$data['model']."</option>";
							}		
							?>
						</select>
					</div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					<div class="form-group">
						<select class="form-control" name="color">
							<option value="" disable selected>Select Colors</option>
							<?php
							foreach($colors as $data){
								$conv=str_replace(" ", "_", $data);
								echo "<option value=".$conv['color'].">".$data['color']."</option>";
							}		
							?>
						</select>
					</div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					<div class="form-group">
						<select class="form-control" name="size">
							<option value="" disable selected>Select Sizes</option>
							<?php 
							foreach($sizes as $data){
								$conv=str_replace(" ", "_", $data);
								echo "<option value=".$conv['size'].">".$data['size']."</option>";
							}		
							?>
						</select>
					</div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					<div class="form-group">
						<select class="form-control" name="user">
							<option value="" disable selected>Select Users</option>
							<?php 
							foreach($users as $data){
								$conv=str_replace(" ", "_", $data);
								echo "<option value=".$conv['username'].">".$data['username']."</option>";
							}		
							?>
						</select>
					</div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input type="text" class="form-control pull-right" id="reservation" name="tanggal" min="2018-01-01" max="2050-12-31">
						</div>
					</div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					<div class="form-group">
						<button type="submit" name="btnSubmit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Filter</button>
					</div>
				</form>       		
			</div>
			<div>
				<table class="table table-bordered table-striped">
					<?php if($tanggal1==null){
							$tanggal1='n';
						}else{
							$tanggal1=$tanggal1;
						}
						if($tanggal2==null){
							$tanggal2='n';
						}else{
							$tanggal2=$tanggal2;
						}
						if($tipe==null){
							$tipe='n';
						}else{
							$tipe=$tipe;
						}
						if($model==null){
							$model='n';
						}else{
							$model=$model;
						}
						if($color==null){
							$color='n';
						}else{
							$color=$color;
						}
						if($size==null){
							$size='n';
						}else{
							$size=$size;
						}
						if($user==null){
							$user='n';
						}else{
							$user=$user;
						}
					?>
					<br/>
					<a href="<?php echo site_url()."controller_monitoring/print_summary_monthly/$tanggal1/$tanggal2/$tipe/$tanggal"?>">
						<button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print Summary</button>
					</a>
					<a href="<?php echo site_url()."controller_monitoring/print_detail_monthly/$tanggal1/$tanggal2/$tipe/$model/$color/$size/$user"?>">
						<button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print Detail</button>
                    </a>
				</table>
			</div>
			<div>
				<div>                          
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr class="bg-light-blue">
								<th>NO</th>
								<th>PRODUCTION</th>
								<th>BRAND</th>
								<th>MODEL</th>
								<th>COLOR</th>
								<th>SIZE</th>
								<th>DESCRIPTION</th>
								<th>TOTAL</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$no=1;
						$subtotal=0;	
							foreach($detail as $data) {	
							?>
							<tr>
								<td><?php echo $no ?></td>
								<td><?php echo $data->production ?></td>	
								<td><?php echo $data->brand ?></td>	
								<td><?php echo $data->model ?></td>	
								<td><?php echo $data->color ?></td>	
								<td><?php echo $data->size ?></td>	
								<td><?php echo $data->description ?></td>	
								<td><?php echo $data->total ?></td>			
							</tr>
							<?php	
							$no++;
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>