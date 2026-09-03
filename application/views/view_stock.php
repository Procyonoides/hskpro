<title>PT HANDAL SUKSES KARYA</title>
	<?php $array_hari=array(1=>'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');$hari=$array_hari[date('N')];?>
	<?php $hari1=date('Y-m-d') ?>
	<?php $jam=date('G:i:s') ?>
<!-- Main content -->
<section class="content">
	<div class="box">
		<div class="box-header">
			<i class="fa fa-archive"></i>
			<h3 class="box-title">Stock</h3>
		</div>
		<div class="box-body">
			<div>                         
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr class="bg-light-blue">
							<th>NO</th>
							<th>MODEL</th>
							<th>COLOR</th>
							<th>SIZE</th>
							<th>BRAND</th>
							<th>ITEM</th>
							<th>PRODUCTION</th>
							<th>STATUS PRODUCTION</th>
							<th>PERCENT</th>
							<th>TOTAL</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=1; 
							foreach($detail as $data) { ?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $data->model; ?></td>	
							<td><?php echo $data->color; ?></td>	
							<td><?php echo $data->size; ?></td>
							<td><?php echo $data->brand; ?></td>
							<td><?php echo $data->item; ?></td>
							<td><?php echo $data->production; ?></td>
							<?php if ($data->status_production == "RUN") { ?>
							<td><span class="badge label-success"><?php echo $data->status_production; ?></span></td>
							<?php } else { ?>
							<td><span class="badge label-danger"><?php echo $data->status_production; ?></span></td>
							<?php } ?>
							<td><span class="label bg-teal"><?php echo $data->percent; ?> %</td>
							<?php if ($data->total > "10000") { ?>
							<td><span class="label bg-red"><?php echo $data->total; ?></span></td>
							<?php } else if ($data->total >= "5000" and $data->total <= "10000") { ?>
							<td><span class="label bg-yellow"><?php echo $data->total; ?></span></td>
							<?php } else if ($data->total >= "1000" and $data->total <= "5000") { ?>
							<td><span class="label bg-green"><?php echo $data->total; ?></span></td>
							<?php } else if ($data->total >= "0" and $data->total <= "1000") { ?>
							<td><span class="label bg-aqua"><?php echo $data->total; ?></span></td>
							<?php } ?>		
						</tr>
						<?php }	?>
					</tbody>
				</table>
			</div>
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