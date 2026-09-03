<html>
<head>
	<title></title>
</head>
<body>
	<h2 align="center">MASTER DATA</h2>
	<table border="1">
		<tr>
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
		</tr>
		<?php
			$subtotal=0;
			foreach($detail as $data){
			$subtotal=$subtotal+$data->stock;	
		?>
		<tr>
			<td align="left"><?php echo $data->original_barcode; ?></td>
			<td align="left"><?php echo $data->brand; ?></td>
			<td align="left"><?php echo $data->color; ?></td>
			<td align="center"><?php echo $data->size; ?></td>
			<td align="center"><?php echo $data->four_digit; ?></td>
			<td align="left"><?php echo $data->unit; ?></td>
			<td align="center"><?php echo $data->quantity; ?></td>
			<td align="left"><?php echo $data->production; ?></td>
			<td align="left"><?php echo $data->model; ?></td>
			<td align="left"><?php echo $data->model_code; ?></td>
			<td align="left"><?php echo $data->item; ?></td>
			<td align="left"><?php echo $data->username; ?></td>
			<td align="left"><?php echo $data->date_time; ?></td>
			<td align="center"><?php echo $data->stock; ?></td>
		</tr>
		<?php }	?>
		<tr>
			<td align="center" colspan="13"><strong>GRAND TOTAL</strong></td>
			<td align="center"><strong><?php echo $subtotal ?></strong></td>
		</tr>
	</table>	
</body>
</html>
