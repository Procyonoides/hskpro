<html>
<head>
	<title></title>
</head>
<body>
	<h3 align="center">DETAIL MONTHLY <?php echo strtoupper($tipe) ?> <?php echo $tanggal1 ?> TO <?php echo $tanggal2 ?></h3>
	<table border="1">
		<tr>
			<th>NO</th>
			<th>PRODUCTION</th>
			<th>BRAND</th>
			<th>MODEL</th>
			<th>ITEM</th>
			<th>COLOR</th>
			<th>SIZE</th>
			<th>DESCRIPTION</th>
			<th>TOTAL</th>
		</tr>
		<?php
			$no=1;		
			$subtotal=0;
			foreach($detail as $data){
			$subtotal=$subtotal+$data->total;	
		?>
		<tr>
			<td align="center"><?php echo $no; ?></td>
			<td><?php echo $data->production; ?></td>
			<td><?php echo $data->brand; ?></td>	
			<td><?php echo $data->model; ?></td>
			<td><?php echo $data->item; ?></td>	
			<td><?php echo $data->color; ?></td>	
			<td align="center"><?php echo $data->size; ?></td>			
			<td><?php echo $data->description; ?></td>			
			<td align="center"><?php echo $data->total; ?></td>					
		</tr>
		<?php 
			$no++;
			}
		?>
		<tr>
			<td align="center" colspan="7"><strong>GRAND TOTAL</strong></td>
			<td align="center"><strong><?php echo $subtotal ?></strong></td>
		</tr>		
	</table>
</body>
</html>