<html>
<head>
	<title></title>
</head>
<body>
	<h3 align="center">DETAIL <?php echo strtoupper($tipe) ?> DATE <?php echo $tanggal ?> TIME <?php echo $jam ?></h3>
	<table border="1">
		<tr>
			<th>SCAN NO</th>
			<th>DATE/TIME</th>
			<th>PRODUCTION</th>
			<th>BRAND</th>
			<th>MODEL</th>
			<th>ITEM</th>
			<th>COLOR</th>
			<th>SIZE</th>
			<th>USERNAME</th>
			<th>DESCRIPTION</th>
			<th>QUANTITY</th>
		</tr>
		<?php 
			$subtotal=0;
			foreach($detail as $data){
			$subtotal=$subtotal+$data->quantity;	
		?>
		<tr>
			<td align="center"><?php echo $data->scan_no; ?></td>
			<td><?php echo $data->date_time; ?></td>
			<td><?php echo $data->production; ?></td>
			<td><?php echo $data->brand; ?></td>	
			<td><?php echo $data->model; ?></td>
			<td><?php echo $data->item; ?></td>	
			<td><?php echo $data->color; ?></td>	
			<td align="center"><?php echo $data->size; ?></td>
			<td><?php echo $data->username; ?></td>
			<td><?php echo $data->description; ?></td>	
			<td align="center"><?php echo $data->quantity; ?></td>					
		</tr>
		<?php }	?>
		<tr>
			<td align="center" colspan="9"><strong>GRAND TOTAL</strong></td>
			<td align="center"><strong><?php echo $subtotal ?></strong></td>
		</tr>		
	</table>
</body>
</html>