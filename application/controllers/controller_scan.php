<?php
class controller_scan extends ci_controller{
	public function __construct(){
		parent:: __construct();
		if($this->session->userdata['username']==NULL){
			echo '<script>alert(\'Please Login\');document.location=\''.base_url('controller_login/home').'\'</script>';
		}
		$this->load->library('datatables');
	}
	
	//get all data for datatable receiving
	function get_guest_json_rec() {
		//$date=$this->model_transaksi->custom_query("select max(date) as date from stok")->row()->date;
		//$now=substr($date, 0, 10);
		header('Content-Type: application/json');
		echo $this->model_scan->get_all_rec();
	}
	
	//get all data for datatable shipping
	function get_guest_json_shi() {
		header('Content-Type: application/json');
		echo $this->model_scan->get_all_shi();
	}
	
	//get data barcode for receiving
	function get_barcode_rec(){
		$date=$_GET['date'];
		$scan=$_GET['scan'];
		$user=$_GET['user'];
		$data=$this->model_scan->get_data_rec($date,$scan,$user);
		echo json_encode($data);
	}
	
	//get data barcode for shipping
	function get_barcode_shi(){
		$date=$_GET['date'];
		$scan=$_GET['scan'];
		$user=$_GET['user'];
		$data=$this->model_scan->get_data_shi($date,$scan,$user);
		echo json_encode($data);
	}
	
	//get all code
	function post_barcode(){
		$barcode=$_POST['barcode'];
		$data=$this->model_monitoring->get_data_by_barcode($barcode);
		echo json_encode($data);
	}
	
	//get all username
	function post_username(){
		$username=$_POST['username'];
		$data=$this->model_scan->get_data_by_username($username);
		echo json_encode($data);
	}
	
	//function edit receiving
	function edit_rec(){
		$date=$_POST['date_edit'];
		$scan=$_POST['scan_edit'];
		$user=$_POST['user'];
		$data=array(
			'original_barcode'	=> $_POST['barcode_edit'],
			'brand'				=> $_POST['brand_edit'],
			'color'				=> $_POST['color_edit'],
			'size'				=> $_POST['size_edit'],
			'four_digit'		=> $_POST['digit_edit'],
			'unit'				=> $_POST['unit_edit'],
			'quantity'			=> $_POST['quantity_edit'],
			'production'		=> $_POST['production_edit'],
			'model'				=> $_POST['model_edit'],
			'model_code'		=> $_POST['code_edit'],
			'item'				=> $_POST['item_edit'],
			'scan_no'			=> $_POST['scan_edit'],
			'username'			=> $_POST['username_edit'],
			'description'		=> $_POST['description_edit']
		);
		$this->db->where('date_time',$date);
		$this->db->where('scan_no',$scan);
		$this->db->where('username',$user);
		$this->db->update('receiving',$data);
		$this->session->set_flashdata
		('msg','<div class="alert bg-aqua alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
			<center>Data Berhasil Diperbarui</center>
			</div>');
		$data['username']=$this->session->userdata['username'];
		$data['usernames']=$this->model_scan->get_username()->result();
		$this->template->load('template_it','view_scanr_it',$data);
	}
	
	//function edit shipping
	function edit_shi(){
		$date=$_POST['date_edit'];
		$scan=$_POST['scan_edit'];
		$user=$_POST['user'];
		$data=array(
			'original_barcode'	=> $_POST['barcode_edit'],
			'brand'				=> $_POST['brand_edit'],
			'color'				=> $_POST['color_edit'],
			'size'				=> $_POST['size_edit'],
			'four_digit'		=> $_POST['digit_edit'],
			'unit'				=> $_POST['unit_edit'],
			'quantity'			=> $_POST['quantity_edit'],
			'production'		=> $_POST['production_edit'],
			'model'				=> $_POST['model_edit'],
			'model_code'		=> $_POST['code_edit'],
			'item'				=> $_POST['item_edit'],
			'scan_no'			=> $_POST['scan_edit'],
			'username'			=> $_POST['username_edit'],
			'description'		=> $_POST['description_edit']
		);
		$this->db->where('date_time',$date);
		$this->db->where('scan_no',$scan);
		$this->db->where('username',$user);
		$this->db->update('shipping',$data);
		$this->session->set_flashdata
		('msg','<div class="alert bg-aqua alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
			<center>Data Berhasil Diperbarui</center>
			</div>');
		$data['username']=$this->session->userdata['username'];
		$data['usernames']=$this->model_scan->get_username()->result();
		$this->template->load('template_it','view_scans_it',$data);
	}
	
	//function delete receiving
	function delete_rec(){
		$date=$_POST['date'];
		$scan=$_POST['scan'];
		$user=$_POST['user'];
		$this->db->where('date_time',$date);
		$this->db->where('scan_no',$scan);
		$this->db->where('username',$user);
		$this->db->delete('receiving');
		$this->session->set_flashdata
		('msg','<div class="alert bg-red alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
			<center>Data Berhasil Dihapus</center>
			</div>');
		$data['username']=$this->session->userdata['username'];
		$data['usernames']=$this->model_scan->get_username()->result();
		$this->template->load('template_it','view_scanr_it',$data);
	}
	
	//function delete shipping
	function delete_shi(){
		$date=$_POST['date'];
		$scan=$_POST['scan'];
		$user=$_POST['user'];
		$this->db->where('date_time',$date);
		$this->db->where('scan_no',$scan);
		$this->db->where('username',$user);
		$this->db->delete('shipping');
		$this->session->set_flashdata
		('msg','<div class="alert bg-red alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
			<center>Data Berhasil Dihapus</center>
			</div>');
		$data['username']=$this->session->userdata['username'];
		$data['usernames']=$this->model_scan->get_username()->result();
		$this->template->load('template_it','view_scans_it',$data);
	}
	
	//page receiving	
	public function receiving(){
		$data['username']=$this->session->userdata['username'];
		$user=$this->session->userdata['username'];
		$data['detail_rec']=$this->model_scan->fetchdatar($user);
		$data['model']="";
		$data['color']="";
		$data['size']="";
		$data['quantity']="";
		$this->template->load('template_receiving','view_scanr',$data);
	}
	
	//page receiving IT
	public function receiving_it(){
		$data['username']=$this->session->userdata['username'];
		$data['usernames']=$this->model_scan->get_username()->result();
		$this->template->load('template_it','view_scanr_it',$data);
	}
	
	//page shipping
	public function shipping(){
		$data['username']=$this->session->userdata['username'];
		$user=$this->session->userdata['username'];
		$data['detail_shi']=$this->model_scan->fetchdatas($user);
		$data['model']="";
		$data['color']="";
		$data['size']="";
		$data['quantity']="";
		$this->template->load('template_shipping','view_scans',$data);
	}
	
	//page shipping IT
	public function shipping_it(){
		$data['username']=$this->session->userdata['username'];
		$data['usernames']=$this->model_scan->get_username()->result();
		$this->template->load('template_it','view_scans_it',$data);
	}
	
	public function getscanrec(){
		$data['username']=$this->session->userdata['username'];
		$user=$this->session->userdata['username'];
		
		$time=date('H:i:s');
		$trans=date('07:30:00');
		$trans2=date('07:30:06');
		//catatan: setiap pukul 07:30:00 - 07:30:06 proses perpindahan data		
		if($time>=$trans && $time<=$trans2){
			$data['model']="-";
			$data['color']="-";
			$data['size']="-";
			$data['quantity']="-";
			$this->session->set_flashdata
			('msg','<div class="alert bg-navy alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
				<center><h1>Harap tidak Melakukan Transaksi sedang Proses Perpindahan Data</h1></center>
				</div>');
		}
		$this->db->select('position');
		$this->db->where('username',$user);
		$query=$this->db->get('users')->row()->position;
		//proteksi username	
		if($query != "RECEIVING"){
			$data['model']="-";
			$data['color']="-";
			$data['size']="-";
			$data['quantity']="-";
			$this->session->set_flashdata
				('msg','<div class="alert bg-navy alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
				<center>Username Tidak Sesuai</center>
				</div>');
		}else{
		$tanggal=date('Y-m-d H:i:s');
		
		$date1=date('Y-m-d 23:59:59');
		$date2=date('Y-m-d 00:00:00');

		$start=date('Y-m-d 07:30:00');

		if($tanggal<=$date1 && $tanggal>=$start){
			$start_date=date('Y-m-d 07:30:00');
			$end_date=date('Y-m-d 07:29:59',strtotime("+1 day"));

			$start_date_before=date('Y-m-d 07:30:00',strtotime("-1 day"));
			$end_date_before=date('Y-m-d 07:29:59');
		}elseif($tanggal>=$date2 && $tanggal<=$start) {
			$start_date=date('Y-m-d 07:30:00',strtotime("-1 day"));
			$end_date=date('Y-m-d 07:29:59');

			$start_date_before=date('Y-m-d 07:30:00',strtotime("-2 day"));
			$end_date_before=date('Y-m-d 07:29:59',strtotime("-1 day"));
		}

		$date=date('Y-m-d H:i:s');
		$date_kemarin=date('Y-m-d',strtotime("-1 day"));
		$date_now=date('Y-m-d');
		$max_date=$this->model_transaksi->custom_query("SELECT MAX(date) AS date FROM stok WHERE CONVERT(VARCHAR, date, 23) <> '$date_now'")->row()->date;
		$maxdate=date('Y-m-d',strtotime($max_date));
		
		$stok=$this->model_transaksi->custom_query("SELECT TOP 1 * FROM stok WHERE CONVERT(VARCHAR, date, 20) BETWEEN '$start_date' AND '$end_date'");
		if($stok->num_rows()>0){
			foreach($stok->result() as $row){
				$stock_awal=$row->stock_awal;
				$receiving=$row->receiving;
				$shipping=$row->shipping;
				$stock_akhir=$row->stock_akhir;
				$date=$row->date;
			}
		}else{
			$stok=$this->model_transaksi->custom_query("SELECT TOP 1 * FROM stok WHERE CONVERT(VARCHAR, date, 20) BETWEEN '$start_date_before' AND '$end_date_before'");
			if($stok->num_rows()>0){
				foreach($stok->result() as $row){
					$stok_awal=$row->stock_akhir;
				}
			}elseif($stok->num_rows()==0){
				$cek_data=$this->model_transaksi->custom_query("SELECT * FROM stok WHERE CONVERT(VARCHAR, date, 23) <> '$date_now'");
				if($cek_data->num_rows()!=0){
					$stok_awal=$this->model_transaksi->custom_query("SELECT stock_akhir AS stock_akhir FROM stok WHERE CONVERT(VARCHAR, date, 23) = '$maxdate'")->row()->stock_akhir;
				}else{
					$stok_awal=0;	
				}
			}
			$data_stok=array(
				'stock_awal'	=> $stok_awal,		
				'receiving'		=> 0,
				'shipping'		=> 0,
				'stock_akhir'	=> $stok_awal,
				'date'			=> $date
			);
			$q=$this->model_transaksi->insert('stok',$data_stok);
		}
		$id=$_POST['barcode'];
		$this->db->where('original_barcode',$id);
		$query=$this->db->get('master_database');
		if ($query->num_rows()!=0)
		{
			$original_barcode=$this->model_scan->getoriginalbarcode($id);
			$brand=$this->model_scan->getbrand($id);
			$color=$this->model_scan->getcolor($id);
			$size=$this->model_scan->getsize($id);
			$four_digit=$this->model_scan->getfourdigit($id);
			$unit=$this->model_scan->getunit($id);
			$quantity=$this->model_scan->getquantity($id);
			$production=$this->model_scan->getproduction($id);
			$model=$this->model_scan->getmodel($id);
			$model_code=$this->model_scan->getmodelcode($id);
			$item=$this->model_scan->getitem($id);
			$username=$user;
			$description=$this->model_scan->getdescription($user);
			$this->model_scan->generatereceiving($original_barcode, $brand, $color, $size, $four_digit, $unit, $quantity, $production, $model, $model_code, $item, $username, $description);
			$data['model']=$this->model_scan->getmodel($id);
			$data['color']=$this->model_scan->getcolor($id);
			$data['size']=$this->model_scan->getsize($id);
			$data['quantity']=$this->model_scan->getquantity($id);
			$this->session->set_flashdata
			('msg','<div class="alert bg-green alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
				<center><h1>Data Berhasil Diinputkan</h1></center>
				</div>');
		}else{
			$data['model']="-";
			$data['color']="-";
			$data['size']="-";
			$data['quantity']="-";
			$this->session->set_flashdata
			('msg','<div class="alert bg-red alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
				<center><h1>Data Gagal Diinputkan</h1></center>
				</div>');
		}
		}
		$data['detail_rec']=$this->model_scan->fetchdatar($user);
		$this->template->load('template_receiving','view_scanr',$data);
	}

	public function getscanshi(){
		$data['username']=$this->session->userdata['username'];
		$user=$this->session->userdata['username'];
		
		$time=date('H:i:s');
		$trans=date('07:30:00');
		$trans2=date('07:30:06');
		//catatan: setiap pukul 07:30:00 - 07:30:06 proses perpindahan data 
		if($time>=$trans && $time<=$trans2){
			$data['model']="-";
			$data['color']="-";
			$data['size']="-";
			$data['quantity']="-";
			$this->session->set_flashdata
			('msg','<div class="alert bg-navy alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
				<center><h1>Harap tidak Melakukan Transaksi sedang Proses Perpindahan Data</h1></center>
				</div>');
		}
		$this->db->select('position');
		$this->db->where('username',$user);
		$query=$this->db->get('users')->row()->position;
		//proteksi username	
		if($query != "SHIPPING"){
			$data['model']="-";
			$data['color']="-";
			$data['size']="-";
			$data['quantity']="-";
			$this->session->set_flashdata
				('msg','<div class="alert bg-navy alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
				<center>Username Tidak Sesuai</center>
				</div>');
		}else{
		$tanggal=date('Y-m-d H:i:s');

		$date1=date('Y-m-d 23:59:59');
		$date2=date('Y-m-d 00:00:00');

		$start=date('Y-m-d 07:30:00');

		if($tanggal<=$date1 && $tanggal>=$start){
			$start_date=date('Y-m-d 07:30:00');
			$end_date=date('Y-m-d 07:29:59',strtotime("+1 day"));

			$start_date_before=date('Y-m-d 07:30:00',strtotime("-1 day"));
			$end_date_before=date('Y-m-d 07:29:59');
		}elseif($tanggal>=$date2 && $tanggal<=$start) {
			$start_date=date('Y-m-d 07:30:00',strtotime("-1 day"));
			$end_date=date('Y-m-d 07:29:59');

			$start_date_before=date('Y-m-d 07:30:00',strtotime("-2 day"));
			$end_date_before=date('Y-m-d 07:29:59',strtotime("-1 day"));
		}

		$date=date('Y-m-d H:i:s');
		$date_kemarin=date('Y-m-d',strtotime("-1 day"));
		$date_now=date('Y-m-d');
		$max_date=$this->model_transaksi->custom_query("SELECT MAX(date) AS date FROM stok WHERE CONVERT(VARCHAR, date, 23) <> '$date_now'")->row()->date;
		$maxdate=date('Y-m-d',strtotime($max_date));
		
		$stok=$this->model_transaksi->custom_query("SELECT TOP 1 * FROM stok WHERE CONVERT(VARCHAR, date, 20) BETWEEN '$start_date' AND '$end_date'");
		if($stok->num_rows()>0){
			foreach($stok->result() as $row){
				$stock_awal=$row->stock_awal;
				$receiving=$row->receiving;
				$shipping=$row->shipping;
				$stock_akhir=$row->stock_akhir;
				$date=$row->date;
			}
		}else{
			$stok=$this->model_transaksi->custom_query("SELECT TOP 1 * FROM stok WHERE CONVERT(VARCHAR, date, 20) BETWEEN '$start_date_before' AND '$end_date_before'");
			if($stok->num_rows()>0){
				foreach($stok->result() as $row){
					$stok_awal=$row->stock_akhir;
				}
			}elseif($stok->num_rows()==0){
				$cek_data=$this->model_transaksi->custom_query("SELECT * FROM stok WHERE CONVERT(VARCHAR, date, 23) <> '$date_now'");
				if($cek_data->num_rows()!=0){
					$stok_awal=$this->model_transaksi->custom_query("SELECT stock_akhir AS stock_akhir FROM stok WHERE CONVERT(VARCHAR, date, 23) = '$maxdate'")->row()->stock_akhir;
				}else{
					$stok_awal=0;	
				}
			}
			$data_stok=array(
				'stock_awal'	=> $stok_awal,		
				'receiving' 	=> 0,
				'shipping'		=> 0,
				'stock_akhir'	=> $stok_awal,
				'date'			=> $date
			);
			$q=$this->model_transaksi->insert('stok',$data_stok);
		}		
		$id=$_POST['barcode'];
		$this->db->where('original_barcode',$id);
		$query=$this->db->get('master_database');
		if ($query->num_rows()!=0)
		{
			$original_barcode=$this->model_scan->getoriginalbarcode($id);
			$brand=$this->model_scan->getbrand($id);
			$color=$this->model_scan->getcolor($id);
			$size=$this->model_scan->getsize($id);
			$four_digit=$this->model_scan->getfourdigit($id);
			$unit=$this->model_scan->getunit($id);
			$quantity=$this->model_scan->getquantity($id);
			$production=$this->model_scan->getproduction($id);
			$model=$this->model_scan->getmodel($id);
			$model_code=$this->model_scan->getmodelcode($id);
			$item=$this->model_scan->getitem($id);
			$username=$user;
			$description=$this->model_scan->getdescription($user);
			$this->model_scan->generateshipping($original_barcode, $brand, $color, $size, $four_digit, $unit, $quantity, $production, $model, $model_code, $item, $username, $description);
			$data['model']=$this->model_scan->getmodel($id);
			$data['color']=$this->model_scan->getcolor($id);
			$data['size']=$this->model_scan->getsize($id);
			$data['quantity']=$this->model_scan->getquantity($id);
			$this->session->set_flashdata
			('msg','<div class="alert bg-green alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
				<center><h1>Data Berhasil Diinputkan</h1></center>
				</div>');
		}else{
			$data['model']="-";
			$data['color']="-";
			$data['size']="-";
			$data['quantity']="-";
			$this->session->set_flashdata
			('msg','<div class="alert bg-red alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
				<center><h1>Data Gagal Diinputkan</h1></center>
				</div>');
		}
		}
		$data['detail_shi']=$this->model_scan->fetchdatas($user);
		$this->template->load('template_shipping','view_scans',$data);	
	}

	public function getscanrec_it(){
		$data['username']=$this->session->userdata['username'];
		$user=$this->session->userdata['username'];
		
		$time=date('H:i:s');
		$trans=date('07:30:00');
		$trans2=date('07:30:06');
		//catatan: setiap pukul 07:30:00 - 07:30:06 proses perpindahan data 
		if($time>=$trans && $time<=$trans2){
		$this->session->set_flashdata
		('msg','<div class="alert bg-navy alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
			<center><h1>Harap tidak Melakukan Transaksi sedang Proses Perpindahan Data</h1></center>
			</div>');
		}
		$this->db->select('position');
		$this->db->where('username',$user);
		$query=$this->db->get('users')->row()->position;
		//proteksi username	
		if($query != "IT"){
			$this->session->set_flashdata
				('msg','<div class="alert bg-navy alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
				<center>Username Tidak Sesuai</center>
				</div>');
		}else{
		$tanggal=date('Y-m-d H:i:s');

		$date1=date('Y-m-d 23:59:59');
		$date2=date('Y-m-d 00:00:00');

		$start=date('Y-m-d 07:30:00');

		if($tanggal<=$date1 && $tanggal>=$start){
			$start_date=date('Y-m-d 07:30:00');
			$end_date=date('Y-m-d 07:29:59',strtotime("+1 day"));

			$start_date_before=date('Y-m-d 07:30:00',strtotime("-1 day"));
			$end_date_before=date('Y-m-d 07:29:59');
		}elseif($tanggal>=$date2 && $tanggal<=$start) {
			$start_date=date('Y-m-d 07:30:00',strtotime("-1 day"));
			$end_date=date('Y-m-d 07:29:59');

			$start_date_before=date('Y-m-d 07:30:00',strtotime("-2 day"));
			$end_date_before=date('Y-m-d 07:29:59',strtotime("-1 day"));
		}

		$date=date('Y-m-d H:i:s');
		$date_kemarin=date('Y-m-d',strtotime("-1 day"));
		$date_now=date('Y-m-d');
		$max_date=$this->model_transaksi->custom_query("SELECT MAX(date) AS date FROM stok WHERE CONVERT(VARCHAR, date, 23) <> '$date_now'")->row()->date;
		$maxdate=date('Y-m-d',strtotime($max_date));
		
		$stok=$this->model_transaksi->custom_query("SELECT TOP 1 * FROM stok WHERE CONVERT(VARCHAR, date, 20) BETWEEN '$start_date' AND '$end_date'");
		if($stok->num_rows()>0){
			foreach($stok->result() as $row){
				$stock_awal=$row->stock_awal;
				$receiving=$row->receiving;
				$shipping=$row->shipping;
				$stock_akhir=$row->stock_akhir;
				$date=$row->date;
			}
		}else{
			$stok=$this->model_transaksi->custom_query("SELECT TOP 1 * FROM stok WHERE CONVERT(VARCHAR, date, 20) BETWEEN '$start_date_before' AND '$end_date_before'");
			if($stok->num_rows()>0){
				foreach($stok->result() as $row){
					$stok_awal=$row->stock_akhir;
				}
			}elseif($stok->num_rows()==0){
				$cek_data=$this->model_transaksi->custom_query("SELECT * FROM stok WHERE CONVERT(VARCHAR, date, 23) <> '$date_now'");
				if($cek_data->num_rows()!=0){
					$stok_awal=$this->model_transaksi->custom_query("SELECT stock_akhir AS stock_akhir FROM stok WHERE CONVERT(VARCHAR, date, 23) = '$maxdate'")->row()->stock_akhir;
				}else{
					$stok_awal=0;	
				}
			}
			$data_stok=array(
				'stock_awal'	=> $stok_awal,		
				'receiving'		=> 0,
				'shipping'		=> 0,
				'stock_akhir'	=> $stok_awal,
				'date'			=> $date
			);
			$q=$this->model_transaksi->insert('stok',$data_stok);
		}		
		$id=$_POST['barcode'];
		$this->db->where('original_barcode',$id);
		$query=$this->db->get('master_database');
		if ($query->num_rows()!=0)
		{
			$original_barcode=$this->model_scan->getoriginalbarcode($id);
			$brand=$this->model_scan->getbrand($id);
			$color=$this->model_scan->getcolor($id);
			$size=$this->model_scan->getsize($id);
			$four_digit=$this->model_scan->getfourdigit($id);
			$unit=$this->model_scan->getunit($id);
			$quantity=$this->model_scan->getquantity($id);
			$production=$this->model_scan->getproduction($id);
			$model=$this->model_scan->getmodel($id);
			$model_code=$this->model_scan->getmodelcode($id);
			$item=$this->model_scan->getitem($id);
			$username=$user;
			$description=$this->model_scan->getdescription($user);
			$this->model_scan->generatereceiving($original_barcode, $brand, $color, $size, $four_digit, $unit, $quantity, $production, $model, $model_code, $item, $username, $description);
			$this->session->set_flashdata
			('msg','<div class="alert bg-green alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
				<center>Data Berhasil Diinputkan</center>
				</div>');
		}else{
			$this->session->set_flashdata
			('msg','<div class="alert bg-red alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
				<center>Data Gagal Diinputkan</center>
				</div>');
		}
		}
		$data['usernames']=$this->model_scan->get_username()->result();
		$this->template->load('template_it','view_scanr_it',$data);
	}

	public function getscanshi_it(){
		$data['username']=$this->session->userdata['username'];
		$user=$this->session->userdata['username'];
		
		$time=date('H:i:s');
		$trans=date('07:30:00');
		$trans2=date('07:30:06');
		//catatan: setiap pukul 07:30:00 - 07:30:06 proses perpindahan data 
		if($time>=$trans && $time<=$trans2){
			$this->session->set_flashdata
			('msg','<div class="alert bg-navy alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
				<center><h1>Harap tidak Melakukan Transaksi sedang Proses Perpindahan Data</h1></center>
				</div>');
		}
		$this->db->select('position');
		$this->db->where('username',$user);
		$query=$this->db->get('users')->row()->position;
		//proteksi username	
		if($query != "IT"){
			$this->session->set_flashdata
				('msg','<div class="alert bg-navy alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
				<center>Username Tidak Sesuai</center>
				</div>');
		}else{
		$tanggal=date('Y-m-d H:i:s');

		$date1=date('Y-m-d 23:59:59');
		$date2=date('Y-m-d 00:00:00');

		$start=date('Y-m-d 07:30:00');

		if($tanggal<=$date1 && $tanggal>=$start){
			$start_date=date('Y-m-d 07:30:00');
			$end_date=date('Y-m-d 07:29:59',strtotime("+1 day"));

			$start_date_before=date('Y-m-d 07:30:00',strtotime("-1 day"));
			$end_date_before=date('Y-m-d 07:29:59');
		}elseif($tanggal>=$date2 && $tanggal<=$start) {
			$start_date=date('Y-m-d 07:30:00',strtotime("-1 day"));
			$end_date=date('Y-m-d 07:29:59');

			$start_date_before=date('Y-m-d 07:30:00',strtotime("-2 day"));
			$end_date_before=date('Y-m-d 07:29:59',strtotime("-1 day"));
		}

		$date=date('Y-m-d H:i:s');
		$date_kemarin=date('Y-m-d',strtotime("-1 day"));
		$date_now=date('Y-m-d');
		$max_date=$this->model_transaksi->custom_query("SELECT MAX(date) AS date FROM stok WHERE CONVERT(VARCHAR, date, 23) <> '$date_now'")->row()->date;
		$maxdate=date('Y-m-d',strtotime($max_date));
		
		$stok=$this->model_transaksi->custom_query("SELECT TOP 1 * FROM stok WHERE CONVERT(VARCHAR, date, 20) BETWEEN '$start_date' AND '$end_date'");
		if($stok->num_rows()>0){
			foreach($stok->result() as $row){
				$stock_awal=$row->stock_awal;
				$receiving=$row->receiving;
				$shipping=$row->shipping;
				$stock_akhir=$row->stock_akhir;
				$date=$row->date;
			}
		}else{
			$stok=$this->model_transaksi->custom_query("SELECT TOP 1 * FROM stok WHERE CONVERT(VARCHAR, date, 20) BETWEEN '$start_date_before' AND '$end_date_before'");
			if($stok->num_rows()>0){
				foreach($stok->result() as $row){
					$stok_awal=$row->stock_akhir;
				}
			}elseif($stok->num_rows()==0){
				$cek_data=$this->model_transaksi->custom_query("SELECT * FROM stok WHERE CONVERT(VARCHAR, date, 23) <> '$date_now'");
				if($cek_data->num_rows()!=0){
					$stok_awal=$this->model_transaksi->custom_query("SELECT stock_akhir AS stock_akhir FROM stok WHERE CONVERT(VARCHAR, date, 23) = '$maxdate'")->row()->stock_akhir;
				}else{
					$stok_awal=0;	
				}
			}
			$data_stok=array(
				'stock_awal'	=> $stok_awal,		
				'receiving'		=> 0,
				'shipping'		=> 0,
				'stock_akhir'	=> $stok_awal,
				'date'			=> $date
			);
			$q=$this->model_transaksi->insert('stok',$data_stok);
		}		
		$id=$_POST['barcode'];
		$this->db->where('original_barcode',$id);
		$query=$this->db->get('master_database');
		if ($query->num_rows()!=0)
		{
			$original_barcode=$this->model_scan->getoriginalbarcode($id);
			$brand=$this->model_scan->getbrand($id);
			$color=$this->model_scan->getcolor($id);
			$size=$this->model_scan->getsize($id);
			$four_digit=$this->model_scan->getfourdigit($id);
			$unit=$this->model_scan->getunit($id);
			$quantity=$this->model_scan->getquantity($id);
			$production=$this->model_scan->getproduction($id);
			$model=$this->model_scan->getmodel($id);
			$model_code=$this->model_scan->getmodelcode($id);
			$item=$this->model_scan->getitem($id);
			$username=$user;
			$description=$this->model_scan->getdescription($user);
			$this->model_scan->generateshipping($original_barcode, $brand, $color, $size, $four_digit, $unit, $quantity, $production, $model, $model_code, $item, $username, $description);
			$this->session->set_flashdata
			('msg','<div class="alert bg-green alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
				<center>Data Berhasil Diinputkan</center>
				</div>');
		}else{
			$this->session->set_flashdata
			('msg','<div class="alert bg-red alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
				<center>Data Gagal Diinputkan</center>
				</div>');
		}
		}
		$data['usernames']=$this->model_scan->get_username()->result();
		$this->template->load('template_it','view_scans_it',$data);
	}
}