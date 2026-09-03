<html>
<head>
	<title></title>
</head>
<body>
	<h3 ALIGN="CENTER">TRANSACTION</h3>
	<div class="body table-responsive">
		<div class="table-wrapper-scroll-y">                          
			<table class="table table-bordered table-fixed" border="1">
				<tr>
					<th>DATE/TIME</th>
					<th>FIRST STOCK</th>
					<th>RECEIVING</th>
					<th>SHIPPING</th>
					<th>WAREHOUSE STOCK</th>
				</tr>
				<?php foreach($detail_stok as $data){ ?>
				<tr>
					<td><?php echo $data->date; ?></td>
					<td align="center"><?php echo $data->stock_awal; ?></td>	
					<td align="center"><?php echo $data->receiving; ?></td>
					<td align="center"><?php echo $data->shipping; ?></td>	
					<td align="center"><?php echo $data->stock_akhir; ?></td>			
				</tr>
				<?php }	?>
			</table>
		</div>
	</div>  		
</body>
</html>	