<title>PT HANDAL SUKSES KARYA</title>
	<?php $array_day=array(1=>'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');$day=$array_day[date('N')];?>
	<?php $tipe="shipping" ?>
	<?php $tanggal=date('Y-m-d') ?>
	<?php $jam=date('G:i:s') ?>
<!-- Main content -->
<section class="content">
	<div class="box">
		<div class="box-header">
			<i class="fa fa-arrow-up"></i>
			<h3 class="box-title">Scan Shipping</h3>
		</div>
		<div class="box-body">
			<div class="header">
				<div class="form-group" align="center">
					<div align="center col-lg-12">
						<button type="button" class="btn btn-warning" style="width:400px;height:100px">
							<i class="fa fa-user"></i>
                            <span><strong><p style="font-size:50px"><?php echo $username ?></p></strong></span>
						</button>
					</div></br>
					<div align="center col-lg-12">
						<button type="button" class="btn btn-default" style="width:400px;height:70px">
                            <span><strong><p style="font-size:40px">OUT</strong></span>
						</button>
					</div></br>
					<div align="center col-lg-12">
						<button type="button" class="btn btn-default" style="width:200px;height:60px">
							<i class="fa fa-calendar"></i>
                            <span><strong><p style="font-size:16px"><?php echo $day.' '.date('Y-m-d') ?></p></strong></span>
						</button>
						<button type="button" class="btn btn-default" style="width:200px;height:60px">
                            <i class="fa fa-clock-o"></i>
                            <span><strong><p id='time' style="font-size:16px"></p></strong></span>
                        </button>
					</div>
				</div>
			</div>
		
			<div class="header bg-yellow" style="height:70px">
				<form method="POST" action="<?php echo site_url('controller_scan/getscanshi');?>">
					<div class="col-lg-12"> 
						<div class="col-lg-3"></div>
						<div class="col-lg-6">
							<div class="input-group margin">
								<div class="input-group-btn">
									<button type="button" class="btn btn-default disabled">Barcode</button>
								</div>
								<input type="text" class="form-control" name="barcode" maxlength="25" size="30" required autofocus>
							</div>
						</div>
						<div class="col-lg-3"></div> 	  
					</div>   
				</form>	
			</div>
				
			<div class="header bg-yellow" style="height:90px">
				<div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div>				
			</div>
				
			<div class="header bg-yellow" style="height:110px">
				<div class="col-lg-12">    
					<strong><p style="font-size:70px" align="center"><?php echo $model ?></p></strong>
				</div>						
			</div>
				
			<div class="header bg-yellow" style="height:80px">
				<div class="col-lg-8">    
					<strong><p style="font-size:55px" align="center"><?php echo $color ?></p></strong>
				</div>					
				<div class="col-lg-2">					
					<strong><p style="font-size:55px" align="center"><?php echo $size ?></p></strong>
				</div>	
				<div class="col-lg-2">
					<strong><p style="font-size:55px" align="center"><?php echo $quantity ?></p></strong>
				</div>					
			</div>
				
			<div class="col-md-12">
				<a href="<?php echo site_url()."controller_monitoring/print_summary_user/$tipe/$tanggal/$jam"?>">
					<button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print Summary</button>
				</a>
				<a href="<?php echo site_url()."controller_monitoring/print_detail/$tipe/$tanggal/$jam"?>">
					<button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print Detail</button>
                </a>
			</div>
			<br/>
			<br/>
			<table class="table table-condensed">
				<thead>
					<tr class="bg-yellow">
						<td align="center"><label>DATE/TIME</label></td>
						<td align="center"><label>BRAND</label></td>
						<td align="center"><label>MODEL</label></td>
						<td align="center"><label>COLOR</label></td>
						<td align="center"><label>SIZE</label></td>
						<td align="center"><label>QUANTITY</label></td>
						<td align="center"><label>USERNAME</label></td>
						<td align="center"><label>SCAN NO</label></td>
					</tr>
				</thead>
				<tbody>
					<?php foreach($detail_shi as $data){?>
					<tr>
						<td align="center"><?php echo $data->date_time ?></td>
						<td align="center"><?php echo $data->brand ?></td>	
						<td align="center"><?php echo $data->model ?></td>	
						<td align="center"><?php echo $data->color ?></td>	
						<td align="center"><?php echo $data->size ?></td>	
						<td align="center"><?php echo $data->quantity ?></td>		
						<td align="center"><?php echo $data->username ?></td>
						<td align="center"><?php echo $data->scan_no ?></td>					
					</tr>
					<?php }	?>
				</tbody>
			</table>		
		</div>
	</div>
</section>