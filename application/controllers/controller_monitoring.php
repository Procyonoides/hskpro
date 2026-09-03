<?php
// Load file autoload.php
require 'vendor/autoload.php';
// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class controller_monitoring extends ci_controller{
	private $filename="import_data";
	public function __construct(){
		parent:: __construct();
		if($this->session->userdata['username']==NULL){
			echo '<script>alert(\'Please Login\');document.location=\''.base_url('controller_login/home').'\'</script>';
		}			
		$this->load->model('model_monitoring');
		$this->load->model('model_transaksi');
		$this->model=$this->model_monitoring;
		$this->load->library('datatables');
	}
	
	//get all data barcode
	function get_guest_json_barcode(){
		header('Content-Type: application/json');
		echo $this->model_monitoring->get_all_barcode();
	}
	
	//get all data transaction
	function get_guest_json_trans(){
		header('Content-Type: application/json');
		echo $this->model_monitoring->get_all_trans();
	}
	
	//get all data record
	function get_guest_json_record(){
		$session_data=$this->session->userdata('datatable');
		$tipe=$session_data['tipe'];
		$date1=$session_data['date1'];
		$date2=$session_data['date2'];
		header('Content-Type: application/json');
		echo $this->model_monitoring->get_all_record($tipe,$date1,$date2);
	}
	
	//get all data model
	function get_guest_json_model(){
		header('Content-Type: application/json');
		echo $this->model_monitoring->get_all_model();
	}
	
	//get all data size
	function get_guest_json_size(){
		header('Content-Type: application/json');
		echo $this->model_monitoring->get_all_size();
	}
	
	//get all data production
	function get_guest_json_production(){
		header('Content-Type: application/json');
		echo $this->model_monitoring->get_all_production();
	}
	
	//get data barcode by original barcode
	function get_barcode(){
		$barcode=$_GET['barcode'];
		$data=$this->model_monitoring->get_data_by_barcode($barcode);
		echo json_encode($data);
	}
	
	//get data transaction by no
	function get_trans(){
		$no=$_GET['no'];
		$data=$this->model_monitoring->get_data_by_no($no);
		echo json_encode($data);
	}
	
	//get data record by original barcode
	function get_record(){
		$session_data=$this->session->userdata('datatable');
		$tipe=$session_data['tipe'];
		$date=$_GET['date'];
		$scan=$_GET['scan'];
		$user=$_GET['user'];
		$data=$this->model_monitoring->get_data_record($tipe,$date,$scan,$user);
		echo json_encode($data);
	}
	
	//get data model by model code
	function get_model(){
		$model_code=$_GET['model_code'];
		$data=$this->model_monitoring->get_data_by_model_code($model_code);
		echo json_encode($data);
	}
	
	//get data size by size code
	function get_size(){
		$size_code=$_GET['size_code'];
		$data=$this->model_monitoring->get_data_by_size_code($size_code);
		echo json_encode($data);
	}
	
	//get data production by production code
	function get_production(){
		$production_code=$_GET['production_code'];
		$data=$this->model_monitoring->get_data_by_production_code($production_code);
		echo json_encode($data);
	}
	
	//get list model
	function post_model(){
		$model=$_POST['model'];
		$data=$this->model_monitoring->get_model_code($model);
		echo json_encode($data);
	}
	
	//get list size
	function post_size(){
		$size=$_POST['size'];
		$data=$this->model_monitoring->get_size_code($size);
		echo json_encode($data);
	}

	//function save barcode
	function save_barcode(){
		$id=$_POST['barcode'];
		$username=$this->session->userdata['username'];
		date_default_timezone_set("Asia/Bangkok");
		$waktu=date('Y-m-d H:i:s');
		$this->db->where('original_barcode',$id);
		$query=$this->db->get('master_database');
		if ($query->num_rows()==0) 
		{
			$data=array(
				'original_barcode'	=> $_POST['barcode'],
				'brand'				=> $_POST['brand'],
				'color'				=> $_POST['color'],
				'size'				=> $_POST['size'],
				'four_digit'		=> $_POST['digit'],
				'unit'				=> $_POST['unit'],
				'quantity'			=> $_POST['quantity'],
				'production'		=> $_POST['production'],
				'model'				=> $_POST['model'],
				'model_code'		=> $_POST['code'],
				'item'				=> $_POST['item'],
				'username'			=> $username,
				'date_time' 		=> $waktu,
				'stock'				=> $_POST['stock']
			);
			$this->db->insert('master_database',$data);
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
		$data['username']=$this->session->userdata['username'];
		$data['model']=$this->model_monitoring->get_model()->result();
		$data['size']=$this->model_monitoring->get_size()->result();
		$data['production']=$this->model_monitoring->get_production()->result();
		$this->template->load('template_it','view_master_data',$data);
	}
	
	//function save model
	function save_model(){
		$model=$_POST['model'];
		$model_code=$_POST['model_code'];
		$this->db->where('model',$model);
		$query=$this->db->get('list_model');
		if ($query->num_rows()==0) 
		{
			$this->db->where('model_code',$model_code);
			$query=$this->db->get('list_model');
			if ($query->num_rows()==0) 
			{
			$input=array(
				'model_code'		=> $this->input->post('model_code'),
				'model'				=> $this->input->post('model')
			);
			$this->db->insert('list_model',$input);
			$this->session->set_flashdata
			('msg','<div class="alert bg-green alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
				<center>Data Berhasil Diinputkan</center>
				</div>');
			}else{
			$this->session->set_flashdata
			('msg','<div class="alert bg-red alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
				<center>Data Kode Model Sudah Terpakai</center>
				</div>');
			} 
		}else{
		$this->session->set_flashdata
		('msg','<div class="alert bg-red alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
			<center>Data Model Sudah Terpakai</center>
			</div>'); 
		}
		$data['username']=$this->session->userdata['username'];	
		$this->template->load('template_it','view_option_model',$data);
	}
	
	//function save size
	function save_size(){
		$size=$_POST['size'];
		$size_code=$_POST['size_code'];
		$this->db->where('size',$size);
		$query=$this->db->get('list_size');
		if ($query->num_rows()==0) 
		{
			$this->db->where('size_code',$size_code);
			$query=$this->db->get('list_size');
			if ($query->num_rows()==0) 
			{
			$input=array(
				'size'			=> $this->input->post('size'),
				'size_code'		=> $this->input->post('size_code')
			);
			$this->db->insert('list_size',$input);
			$this->session->set_flashdata
			('msg','<div class="alert bg-green alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
				<center>Data Berhasil Diinputkan</center>
				</div>');
			}else{
			$this->session->set_flashdata
			('msg','<div class="alert bg-red alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
				<center>Data Kode Size Sudah Terpakai</center>
				</div>');
			} 
		}else{
		$this->session->set_flashdata
		('msg','<div class="alert bg-red alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
			<center>Data Size Sudah Terpakai</center>
			</div>');
		}
		$data['username']=$this->session->userdata['username'];		
		$this->template->load('template_it','view_option_size',$data);
	}
	
	//function save production
	function save_production(){
		$production=$_POST['production'];
		$production_code=$_POST['production_code'];
		$this->db->where('production',$production);
		$query=$this->db->get('list_production');
		if ($query->num_rows()==0) 
		{
			$this->db->where('production_code',$production_code);
			$query=$this->db->get('list_production');
			if ($query->num_rows()==0) 
			{
			$input=array(
				'production'			=> $this->input->post('production'),
				'production_code'		=> $this->input->post('production_code')
			);
			$this->db->insert('list_production',$input);
			$this->session->set_flashdata
			('msg','<div class="alert bg-green alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
				<center>Data Berhasil Diinputkan</center>
				</div>');
			}else{
			$this->session->set_flashdata
			('msg','<div class="alert bg-red alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
				<center>Data Kode Production Sudah Terpakai</center>
				</div>');
			} 
		}else{
		$this->session->set_flashdata
		('msg','<div class="alert bg-red alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
			<center>Data Production Sudah Terpakai</center>
			</div>');
		}
		$data['username']=$this->session->userdata['username'];			
		$this->template->load('template_it','view_option_production',$data);
	}

	//function edit barcode
	function edit_barcode(){
		$barcode=$_POST['barcode_edit'];
		$data=array(
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
			'username'			=> $_POST['username_edit'],
			'date_time'			=> $_POST['date_edit'],
			'stock'				=> $_POST['stock_edit']
		);
		$this->db->where('original_barcode',$barcode);
		$this->db->update('master_database',$data);
		$this->session->set_flashdata
		('msg','<div class="alert bg-aqua alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
			<center>Data Berhasil Diperbarui</center>
			</div>');
		$data['username']=$this->session->userdata['username'];
		$data['model']=$this->model_monitoring->get_model()->result();
		$data['size']=$this->model_monitoring->get_size()->result();
		$data['production']=$this->model_monitoring->get_production()->result();
		$this->template->load('template_it','view_master_data',$data);
	}
	
	//function edit transaction
	function edit_transaction(){
		$no=$_POST['no_edit'];
		$data=array(
			'stock_awal'		=> $_POST['awal_edit'],
			'receiving'			=> $_POST['receiving_edit'],
			'shipping'			=> $_POST['shipping_edit'],
			'stock_akhir'		=> $_POST['akhir_edit']
		);
		$this->db->where('no',$no);
		$this->db->update('stok',$data);
		$this->session->set_flashdata
		('msg','<div class="alert bg-aqua alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
			<center>Data Berhasil Diperbarui</center>
			</div>');
		$data['username']=$this->session->userdata['username'];
		$this->template->load('template_it','view_transaction',$data);
	}
	
	
	//function edit record
	function edit_record(){
		$session_data=$this->session->userdata('datatable');
		$tipe=$session_data['tipe'];
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
		$this->db->update('"'.$tipe.'"',$data);
		$this->session->set_flashdata
		('msg','<div class="alert bg-aqua alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
			<center>Data Berhasil Diperbarui</center>
			</div>');
		$data['username']=$this->session->userdata['username'];
		$data['usernames']=$this->model_scan->get_username()->result();
		$this->template->load('template_it','view_record',$data);
	}
	
	//function edit model
	function edit_model(){
		$model_code=$_POST['model_code_edit'];
		$data=array(
			'model'				=> $_POST['model_edit']
		);
		$this->db->where('model_code',$model_code);
		$this->db->update('list_model',$data);
		$this->session->set_flashdata
		('msg','<div class="alert bg-aqua alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
			<center>Data Berhasil Diperbarui</center>
			</div>');
		$data['username']=$this->session->userdata['username'];;
		$this->template->load('template_it','view_option_model',$data);
	}
	
	//function edit size
	function edit_size(){
		$size_code=$_POST['size_code_edit'];
		$data=array(
			'size'				=> $_POST['size_edit']
		);
		$this->db->where('size_code',$size_code);
		$this->db->update('list_size',$data);
		$this->session->set_flashdata
		('msg','<div class="alert bg-aqua alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
			<center>Data Berhasil Diperbarui</center>
			</div>');
		$data['username']=$this->session->userdata['username'];;
		$this->template->load('template_it','view_option_size',$data);
	}
	
	//function edit production
	function edit_production(){
		$production_code=$_POST['production_code_edit'];
		$data=array(
			'production'		=> $_POST['production_edit']
		);
		$this->db->where('production_code',$production_code);
		$this->db->update('list_production',$data);
		$this->session->set_flashdata
		('msg','<div class="alert bg-aqua alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
			<center>Data Berhasil Diperbarui</center>
			</div>');
		$data['username']=$this->session->userdata['username'];;
		$this->template->load('template_it','view_option_production',$data);
	}

	//function delete barcode
	function delete_barcode(){
		$barcode=$_POST['barcode'];
		$this->db->where('original_barcode',$barcode);
		$this->db->delete('master_database');
		$this->session->set_flashdata
		('msg','<div class="alert bg-red alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
			<center>Data Berhasil Dihapus</center>
			</div>');
		$data['username']=$this->session->userdata['username'];
		$data['model']=$this->model_monitoring->get_model()->result();
		$data['size']=$this->model_monitoring->get_size()->result();
		$data['production']=$this->model_monitoring->get_production()->result();
		$this->template->load('template_it','view_master_data',$data);
	}
	
	//function delete transaction
	function delete_transaction(){
		$no=$_POST['no'];
		$this->db->where('no',$no);
		$this->db->delete('stok');
		$this->session->set_flashdata
		('msg','<div class="alert bg-red alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
			<center>Data Berhasil Dihapus</center>
			</div>');
		$data['username']=$this->session->userdata['username'];
		$this->template->load('template_it','view_transaction',$data);
	}
	
	//function delete record
	function delete_record(){
		$session_data=$this->session->userdata('datatable');
		$tipe=$session_data['tipe'];
		$date=$_POST['date'];
		$scan=$_POST['scan'];
		$user=$_POST['user'];
		$this->db->where('date_time',$date);
		$this->db->where('scan_no',$scan);
		$this->db->where('username',$user);
		$this->db->delete('"'.$tipe.'"');
		$this->session->set_flashdata
		('msg','<div class="alert bg-red alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
			<center>Data Berhasil Dihapus</center>
			</div>');
		$data['username']=$this->session->userdata['username'];
		$data['usernames']=$this->model_scan->get_username()->result();
		$this->template->load('template_it','view_record',$data);
	}
	
	//function delete model
	function delete_model(){
		$model_code=$_POST['model_code'];
		$this->db->where('model_code',$model_code);
		$this->db->delete('list_model');
		$this->session->set_flashdata
		('msg','<div class="alert bg-red alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
			<center>Data Berhasil Dihapus</center>
			</div>');
		$data['username']=$this->session->userdata['username'];
		$this->template->load('template_it','view_option_model',$data);
	}
	
	//function delete size
	function delete_size(){
		$size_code=$_POST['size_code'];
		$this->db->where('size_code',$size_code);
		$this->db->delete('list_size');
		$this->session->set_flashdata
		('msg','<div class="alert bg-red alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
			<center>Data Berhasil Dihapus</center>
			</div>');
		$data['username']=$this->session->userdata['username'];
		$this->template->load('template_it','view_option_size',$data);
	}
	
	//function delete production
	function delete_production(){
		$production_code=$_POST['production_code'];
		$this->db->where('production_code',$production_code);
		$this->db->delete('list_production');
		$this->session->set_flashdata
		('msg_model','<div class="alert bg-red alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
			<center>Data Berhasil Dihapus</center>
			</div>');
		$data['username']=$this->session->userdata['username'];
		$this->template->load('template_it','view_option_production',$data);
	}
	
	function option_model(){
		$data['username']=$this->session->userdata['username'];
		$this->template->load('template_it','view_option_model',$data);
	}
	
	function option_size(){
		$data['username']=$this->session->userdata['username'];
		$this->template->load('template_it','view_option_size',$data);
	}
	
	function option_production(){
		$data['username']=$this->session->userdata['username'];
		$this->template->load('template_it','view_option_production',$data);
	}
	
	//page transaction
	public function transaction(){
		$data['username']=$this->session->userdata['username'];
		$this->template->load('template_it','view_transaction',$data);
	}
	
	//page master data
	public function master(){
		$data['username']=$this->session->userdata['username'];
		$data['model']=$this->model_monitoring->get_model()->result();
		$data['size']=$this->model_monitoring->get_size()->result();
		$data['production']=$this->model_monitoring->get_production()->result();
		$this->template->load('template_it','view_master_data',$data);
	}
	
	//page stock IT
	public function stock_it(){
		$data['username']=$this->session->userdata['username'];
		$data['model']=$this->model_monitoring->get_model()->result();
		$data['size']=$this->model_monitoring->get_size()->result();
		$data['production']=$this->model_monitoring->get_production()->result();
		$data['detail']=$this->model_monitoring->get_stock()->result();
		$this->template->load('template_it','view_stock',$data);
	}

	//page stock Management
	public function stock_management(){
		$data['username']=$this->session->userdata['username'];
		$data['model']=$this->model_monitoring->get_model()->result();
		$data['size']=$this->model_monitoring->get_size()->result();
		$data['production']=$this->model_monitoring->get_production()->result();
		$data['detail']=$this->model_monitoring->get_stock()->result();
		$this->template->load('template_management','view_stock',$data);
	}
	
	//page delivery
	public function delivery(){
		$data['username']=$this->session->userdata['username'];
		$this->template->load('template_it','view_delivery',$data);
	}
	
	//page daily report IT
	public function daily_it(){
		$data['username']=$this->session->userdata['username'];
		$tanggal1="";
		$tanggal2="";
		$tipe="";
		$model="";
		$color="";
		$size="";
		$user="";
		if(isset($_POST['btnSubmit'])){
			$y1=substr($_POST['tanggal'],6,4);
			$m1=substr($_POST['tanggal'],0,2);
			$d1=substr($_POST['tanggal'],3,2);
			$tanggal1=$y1. '-' .$m1. '-' .$d1;
			$y2=substr($_POST['tanggal'],-4,4);
			$m2=substr($_POST['tanggal'],-10,2);
			$d2=substr($_POST['tanggal'],-7,2);
			$tanggal2=$y2. '-' .$m2. '-' .$d2;
			$tipe=$_POST['tipe'];
			$model=$_POST['model'];
			$color=str_replace("_", " ", $_POST['color']);
			$size=$_POST['size'];
			$user=$_POST['user'];
			$data['models']=$this->model_monitoring->getmodel();
			$data['colors']=$this->model_monitoring->getcolor();
			$data['sizes']=$this->model_monitoring->getsize();
			$data['users']=$this->model_monitoring->getuser();
			if($tipe=="receiving"){
				if($model!=null && $color!=null && $size!=null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND size='$size' AND username='$user' ORDER BY date_time")->result();
				}elseif($model!=null && $color!=null && $size!=null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND size='$size' ORDER BY date_time")->result();	
				}elseif($model!=null && $color!=null && $size==null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND username='$user' ORDER BY date_time")->result();
				}elseif($model!=null && $color==null && $size!=null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND size='$size' AND username='$user' ORDER BY date_time")->result();	
				}elseif($model==null && $color!=null && $size!=null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND size='$size' AND username='$user' ORDER BY date_time")->result();	
				}elseif($model!=null && $color!=null && $size==null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' ORDER BY date_time")->result();	
				}elseif($model==null && $color==null && $size!=null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND size='$size' AND username='$user' ORDER BY date_time")->result();	
				}elseif($model!=null && $color==null && $size!=null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND size='$size' ORDER BY date_time")->result();	
				}elseif($model==null && $color!=null && $size==null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND username='$user' ORDER BY date_time")->result();	
				}elseif($model!=null && $color==null && $size==null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND username='$user' ORDER BY date_time")->result();	
				}elseif($model==null && $color!=null && $size!=null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND size='$size' ORDER BY date_time")->result();	
				}elseif($model!=null && $color==null && $size==null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' ORDER BY date_time")->result();	
				}elseif($model==null && $color!=null && $size==null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' ORDER BY date_time")->result();	
				}elseif($model==null && $color==null && $size!=null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND size='$size' ORDER BY date_time")->result();	
				}elseif($model==null && $color==null && $size==null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND username='$user' ORDER BY date_time")->result();	
				}else{
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' ORDER BY date_time")->result();
				}
			}elseif($tipe=="shipping"){
				if($model!=null && $color!=null && $size!=null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND size='$size' AND username='$user' ORDER BY date_time")->result();
				}elseif($model!=null && $color!=null && $size!=null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND size='$size' ORDER BY date_time")->result();	
				}elseif($model!=null && $color!=null && $size==null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND username='$user' ORDER BY date_time")->result();
				}elseif($model!=null && $color==null && $size!=null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND size='$size' AND username='$user' ORDER BY date_time")->result();	
				}elseif($model==null && $color!=null && $size!=null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND size='$size' AND username='$user' ORDER BY date_time")->result();	
				}elseif($model!=null && $color!=null && $size==null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' ORDER BY date_time")->result();	
				}elseif($model==null && $color==null && $size!=null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND size='$size' AND username='$user' ORDER BY date_time")->result();	
				}elseif($model!=null && $color==null && $size!=null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND size='$size' ORDER BY date_time")->result();	
				}elseif($model==null && $color!=null && $size==null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND username='$user' ORDER BY date_time")->result();	
				}elseif($model!=null && $color==null && $size==null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND username='$user' ORDER BY date_time")->result();	
				}elseif($model==null && $color!=null && $size!=null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND size='$size' ORDER BY date_time")->result();	
				}elseif($model!=null && $color==null && $size==null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' ORDER BY date_time")->result();	
				}elseif($model==null && $color!=null && $size==null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' ORDER BY date_time")->result();	
				}elseif($model==null && $color==null && $size!=null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND size='$size' ORDER BY date_time")->result();	
				}elseif($model==null && $color==null && $size==null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND username='$user' ORDER BY date_time")->result();	
				}else{
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' ORDER BY date_time")->result();
				}
			}
		}
		else{
			$data['models']=$this->model_monitoring->getmodel();
			$data['colors']=$this->model_monitoring->getcolor();
			$data['sizes']=$this->model_monitoring->getsize();
			$data['users']=$this->model_monitoring->getuser();
			$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE model='0'")->result();	
		}
		$data['tanggal1']=$tanggal1;
		$data['tanggal2']=$tanggal2;
		$data['tipe']=$tipe;
		$data['model']=$model;
		$data['color']=$color;
		$data['size']=$size;
		$data['user']=$user;
		$this->template->load('template_it','view_daily_it',$data);
	}
	
	//page today report Management
	public function today_management(){
		$data['username']=$this->session->userdata['username'];
		$tipe="";
		if(isset($_POST['btnSubmit'])){
			$tipe=$_POST['tipe'];
			if($tipe=="receiving"){
				$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM receiving ORDER BY date_time")->result();
			}
			elseif($tipe=="shipping"){
				$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM shipping ORDER BY date_time")->result();
			}
		}
		else{
			$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM shipping WHERE model='0'")->result();	
		}
		$data['tipe']=$tipe;
		$this->template->load('template_management','view_today_management',$data);
	}
	
	//page daily report Management
	public function daily_management(){
		$data['username']=$this->session->userdata['username'];
		$tanggal1="";
		$tanggal2="";
		$tipe="";
		$model="";
		$color="";
		$size="";
		$user="";
		if(isset($_POST['btnSubmit'])){
			$y1=substr($_POST['tanggal'],6,4);
			$m1=substr($_POST['tanggal'],0,2);
			$d1=substr($_POST['tanggal'],3,2);
			$tanggal1=$y1. '-' .$m1. '-' .$d1;
			$y2=substr($_POST['tanggal'],-4,4);
			$m2=substr($_POST['tanggal'],-10,2);
			$d2=substr($_POST['tanggal'],-7,2);
			$tanggal2=$y2. '-' .$m2. '-' .$d2;
			$tipe=$_POST['tipe'];
			$model=$_POST['model'];
			$color=str_replace("_", " ", $_POST['color']);
			$size=$_POST['size'];
			$user=$_POST['user'];
			$data['models']=$this->model_monitoring->getmodel();
			$data['colors']=$this->model_monitoring->getcolor();
			$data['sizes']=$this->model_monitoring->getsize();
			$data['users']=$this->model_monitoring->getuser();
			if($tipe=="receiving"){
				if($model!=null && $color!=null && $size!=null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND size='$size' AND username='$user' ORDER BY date_time")->result();
				}elseif($model!=null && $color!=null && $size!=null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND size='$size' ORDER BY date_time")->result();	
				}elseif($model!=null && $color!=null && $size==null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND username='$user' ORDER BY date_time")->result();
				}elseif($model!=null && $color==null && $size!=null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND size='$size' AND username='$user' ORDER BY date_time")->result();	
				}elseif($model==null && $color!=null && $size!=null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND size='$size' AND username='$user' ORDER BY date_time")->result();	
				}elseif($model!=null && $color!=null && $size==null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' ORDER BY date_time")->result();	
				}elseif($model==null && $color==null && $size!=null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND size='$size' AND username='$user' ORDER BY date_time")->result();	
				}elseif($model!=null && $color==null && $size!=null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND size='$size' ORDER BY date_time")->result();	
				}elseif($model==null && $color!=null && $size==null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND username='$user' ORDER BY date_time")->result();	
				}elseif($model!=null && $color==null && $size==null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND username='$user' ORDER BY date_time")->result();	
				}elseif($model==null && $color!=null && $size!=null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND size='$size' ORDER BY date_time")->result();	
				}elseif($model!=null && $color==null && $size==null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' ORDER BY date_time")->result();	
				}elseif($model==null && $color!=null && $size==null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' ORDER BY date_time")->result();	
				}elseif($model==null && $color==null && $size!=null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND size='$size' ORDER BY date_time")->result();	
				}elseif($model==null && $color==null && $size==null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND username='$user' ORDER BY date_time")->result();	
				}else{
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' ORDER BY date_time")->result();
				}
			}elseif($tipe=="shipping"){
				if($model!=null && $color!=null && $size!=null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND size='$size' AND username='$user' ORDER BY date_time")->result();
				}elseif($model!=null && $color!=null && $size!=null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND size='$size' ORDER BY date_time")->result();	
				}elseif($model!=null && $color!=null && $size==null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND username='$user' ORDER BY date_time")->result();
				}elseif($model!=null && $color==null && $size!=null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND size='$size' AND username='$user' ORDER BY date_time")->result();	
				}elseif($model==null && $color!=null && $size!=null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND size='$size' AND username='$user' ORDER BY date_time")->result();	
				}elseif($model!=null && $color!=null && $size==null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' ORDER BY date_time")->result();	
				}elseif($model==null && $color==null && $size!=null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND size='$size' AND username='$user' ORDER BY date_time")->result();	
				}elseif($model!=null && $color==null && $size!=null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND size='$size' ORDER BY date_time")->result();	
				}elseif($model==null && $color!=null && $size==null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND username='$user' ORDER BY date_time")->result();	
				}elseif($model!=null && $color==null && $size==null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND username='$user' ORDER BY date_time")->result();	
				}elseif($model==null && $color!=null && $size!=null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND size='$size' ORDER BY date_time")->result();	
				}elseif($model!=null && $color==null && $size==null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' ORDER BY date_time")->result();	
				}elseif($model==null && $color!=null && $size==null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' ORDER BY date_time")->result();	
				}elseif($model==null && $color==null && $size!=null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND size='$size' ORDER BY date_time")->result();	
				}elseif($model==null && $color==null && $size==null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND username='$user' ORDER BY date_time")->result();	
				}else{
					$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' ORDER BY date_time")->result();
				}
			}
		}
		else{
			$data['models']=$this->model_monitoring->getmodel();
			$data['colors']=$this->model_monitoring->getcolor();
			$data['sizes']=$this->model_monitoring->getsize();
			$data['users']=$this->model_monitoring->getuser();
			$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE model='0'")->result();	
		}
		$data['tanggal1']=$tanggal1;
		$data['tanggal2']=$tanggal2;
		$data['tipe']=$tipe;
		$data['model']=$model;
		$data['color']=$color;
		$data['size']=$size;
		$data['user']=$user;
		$this->template->load('template_management','view_daily_management',$data);
	}
	
	//page monthly report IT
	public function monthly_it(){
		$data['username']=$this->session->userdata['username'];
		$tanggal1="";
		$tanggal2="";
		$tipe="";
		$model="";
		$color="";
		$size="";
		$user="";
		if(isset($_POST['btnSubmit'])){
			$y1=substr($_POST['tanggal'],6,4);
			$m1=substr($_POST['tanggal'],0,2);
			$d1=substr($_POST['tanggal'],3,2);
			$tanggal1=$y1. '-' .$m1. '-' .$d1;
			$y2=substr($_POST['tanggal'],-4,4);
			$m2=substr($_POST['tanggal'],-10,2);
			$d2=substr($_POST['tanggal'],-7,2);
			$tanggal2=$y2. '-' .$m2. '-' .$d2;
			$tipe=$_POST['tipe'];
			$model=$_POST['model'];
			$color=str_replace("_", " ", $_POST['color']);
			$size=$_POST['size'];
			$user=$_POST['user'];
			$data['models']=$this->model_monitoring->getmodel();
			$data['colors']=$this->model_monitoring->getcolor();
			$data['sizes']=$this->model_monitoring->getsize();
			$data['users']=$this->model_monitoring->getuser();
			if($tipe=="receiving"){
				if($model!=null && $color!=null && $size!=null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND size='$size' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();
				}elseif($model!=null && $color!=null && $size!=null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND size='$size' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model!=null && $color!=null && $size==null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();
				}elseif($model!=null && $color==null && $size!=null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND size='$size' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model==null && $color!=null && $size!=null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND size='$size' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model!=null && $color!=null && $size==null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model==null && $color==null && $size!=null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND size='$size' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model!=null && $color==null && $size!=null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND size='$size' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model==null && $color!=null && $size==null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model!=null && $color==null && $size==null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model==null && $color!=null && $size!=null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND size='$size' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model!=null && $color==null && $size==null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model==null && $color!=null && $size==null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model==null && $color==null && $size!=null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND size='$size' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model==null && $color==null && $size==null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}else{
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();
				}
			}elseif($tipe=="shipping"){
				if($model!=null && $color!=null && $size!=null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND size='$size' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();
				}elseif($model!=null && $color!=null && $size!=null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND size='$size' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model!=null && $color!=null && $size==null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();
				}elseif($model!=null && $color==null && $size!=null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND size='$size' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model==null && $color!=null && $size!=null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND size='$size' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model!=null && $color!=null && $size==null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model==null && $color==null && $size!=null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND size='$size' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model!=null && $color==null && $size!=null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND size='$size' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model==null && $color!=null && $size==null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model!=null && $color==null && $size==null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model==null && $color!=null && $size!=null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND size='$size' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model!=null && $color==null && $size==null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model==null && $color!=null && $size==null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model==null && $color==null && $size!=null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND size='$size' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model==null && $color==null && $size==null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}else{
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();
				}
			}
		}
		else{
			$data['models']=$this->model_monitoring->getmodel();
			$data['colors']=$this->model_monitoring->getcolor();
			$data['sizes']=$this->model_monitoring->getsize();
			$data['users']=$this->model_monitoring->getuser();
			$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE model='0'")->result();	
		}
		$data['tanggal1']=$tanggal1;
		$data['tanggal2']=$tanggal2;
		$data['tipe']=$tipe;
		$data['model']=$model;
		$data['color']=$color;
		$data['size']=$size;
		$data['user']=$user;
		$this->template->load('template_it','view_monthly_it',$data);
	}
	
	//page monthly report Management
	public function monthly_management(){
		$data['username']=$this->session->userdata['username'];
		$tanggal1="";
		$tanggal2="";
		$tipe="";
		$model="";
		$color="";
		$size="";
		$user="";
		if(isset($_POST['btnSubmit'])){
			$y1=substr($_POST['tanggal'],6,4);
			$m1=substr($_POST['tanggal'],0,2);
			$d1=substr($_POST['tanggal'],3,2);
			$tanggal1=$y1. '-' .$m1. '-' .$d1;
			$y2=substr($_POST['tanggal'],-4,4);
			$m2=substr($_POST['tanggal'],-10,2);
			$d2=substr($_POST['tanggal'],-7,2);
			$tanggal2=$y2. '-' .$m2. '-' .$d2;
			$tipe=$_POST['tipe'];
			$model=$_POST['model'];
			$color=str_replace("_", " ", $_POST['color']);
			$size=$_POST['size'];
			$user=$_POST['user'];
			$data['models']=$this->model_monitoring->getmodel();
			$data['colors']=$this->model_monitoring->getcolor();
			$data['sizes']=$this->model_monitoring->getsize();
			$data['users']=$this->model_monitoring->getuser();
			if($tipe=="receiving"){
				if($model!=null && $color!=null && $size!=null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND size='$size' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();
				}elseif($model!=null && $color!=null && $size!=null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND size='$size' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model!=null && $color!=null && $size==null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();
				}elseif($model!=null && $color==null && $size!=null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND size='$size' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model==null && $color!=null && $size!=null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND size='$size' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model!=null && $color!=null && $size==null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model==null && $color==null && $size!=null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND size='$size' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model!=null && $color==null && $size!=null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND size='$size' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model==null && $color!=null && $size==null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model!=null && $color==null && $size==null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model==null && $color!=null && $size!=null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND size='$size' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model!=null && $color==null && $size==null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model==null && $color!=null && $size==null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model==null && $color==null && $size!=null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND size='$size' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model==null && $color==null && $size==null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}else{
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();
				}
			}elseif($tipe=="shipping"){
				if($model!=null && $color!=null && $size!=null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND size='$size' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();
				}elseif($model!=null && $color!=null && $size!=null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND size='$size' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model!=null && $color!=null && $size==null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();
				}elseif($model!=null && $color==null && $size!=null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND size='$size' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model==null && $color!=null && $size!=null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND size='$size' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model!=null && $color!=null && $size==null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model==null && $color==null && $size!=null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND size='$size' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model!=null && $color==null && $size!=null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND size='$size' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model==null && $color!=null && $size==null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model!=null && $color==null && $size==null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model==null && $color!=null && $size!=null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND size='$size' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model!=null && $color==null && $size==null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model==null && $color!=null && $size==null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model==null && $color==null && $size!=null && $user==null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND size='$size' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}elseif($model==null && $color==null && $size==null && $user!=null){
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
				}else{
					$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();
				}
			}
		}
		else{
			$data['models']=$this->model_monitoring->getmodel();
			$data['colors']=$this->model_monitoring->getcolor();
			$data['sizes']=$this->model_monitoring->getsize();
			$data['users']=$this->model_monitoring->getuser();
			$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE model='0'")->result();	
		}
		$data['tanggal1']=$tanggal1;
		$data['tanggal2']=$tanggal2;
		$data['tipe']=$tipe;
		$data['model']=$model;
		$data['color']=$color;
		$data['size']=$size;
		$data['user']=$user;
		$this->template->load('template_management','view_monthly_management',$data);
	}
	
	//print master data
	public function print_master_data(){
		$data['username']=$this->session->userdata['username'];
		header("Content-type=appalication/vnd.ms.excel");
		header("Content-disposition: attachment; filename=Master Data.xls");
		$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM master_database ORDER BY original_barcode")->result();
		$this->load->view('excel_master_data',$data);
	}

	//print detail daily
	public function print_detail_daily($tanggal1,$tanggal2,$tipe,$model,$color,$size,$user){
		$data['username']=$this->session->userdata['username'];
		$model=preg_replace('/%20/', ' ', $model);
		$color=preg_replace('/%20/', ' ', $color);
		$size=preg_replace('/%20/', ' ', $size);
		$user=preg_replace('/%20/', ' ', $user);
		if($tipe=="receiving"){
			if($model!='n' && $color!='n' && $size!='n' && $user!='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND size='$size' AND username='$user' ORDER BY date_time")->result();
			}elseif($model!='n' && $color!='n' && $size!='n' && $user=='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND size='$size' ORDER BY date_time")->result();	
			}elseif($model!='n' && $color!='n' && $size=='n' && $user!='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND username='$user' ORDER BY date_time")->result();
			}elseif($model!='n' && $color=='n' && $size!='n' && $user!='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND size='$size' AND username='$user' ORDER BY date_time")->result();	
			}elseif($model=='n' && $color!='n' && $size!='n' && $user!='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND size='$size' AND username='$user' ORDER BY date_time")->result();	
			}elseif($model!='n' && $color!='n' && $size=='n' && $user=='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' ORDER BY date_time")->result();	
			}elseif($model=='n' && $color=='n' && $size!='n' && $user!='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND size='$size' AND username='$user' ORDER BY date_time")->result();	
			}elseif($model!='n' && $color=='n' && $size!='n' && $user=='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND size='$size' ORDER BY date_time")->result();	
			}elseif($model=='n' && $color!='n' && $size=='n' && $user!='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND username='$user' ORDER BY date_time")->result();	
			}elseif($model!='n' && $color=='n' && $size=='n' && $user!='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND username='$user' ORDER BY date_time")->result();	
			}elseif($model=='n' && $color!='n' && $size!='n' && $user=='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND size='$size' ORDER BY date_time")->result();	
			}elseif($model!='n' && $color=='n' && $size=='n' && $user=='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' ORDER BY date_time")->result();	
			}elseif($model=='n' && $color!='n' && $size=='n' && $user=='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' ORDER BY date_time")->result();	
			}elseif($model=='n' && $color=='n' && $size!='n' && $user=='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND size='$size' ORDER BY date_time")->result();	
			}elseif($model=='n' && $color=='n' && $size=='n' && $user!='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND username='$user' ORDER BY date_time")->result();	
			}else{
				$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' ORDER BY date_time")->result();
			}
		}elseif($tipe="shipping") {
			if($model!='n' && $color!='n' && $size!='n' && $user!='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND size='$size' AND username='$user' ORDER BY date_time")->result();
			}elseif($model!='n' && $color!='n' && $size!='n' && $user=='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND size='$size' ORDER BY date_time")->result();	
			}elseif($model!='n' && $color!='n' && $size=='n' && $user!='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND username='$user' ORDER BY date_time")->result();
			}elseif($model!='n' && $color=='n' && $size!='n' && $user!='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND size='$size' AND username='$user' ORDER BY date_time")->result();	
			}elseif($model=='n' && $color!='n' && $size!='n' && $user!='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND size='$size' AND username='$user' ORDER BY date_time")->result();	
			}elseif($model!='n' && $color!='n' && $size=='n' && $user=='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' ORDER BY date_time")->result();	
			}elseif($model=='n' && $color=='n' && $size!='n' && $user!='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND size='$size' AND username='$user' ORDER BY date_time")->result();	
			}elseif($model!='n' && $color=='n' && $size!='n' && $user=='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND size='$size' ORDER BY date_time")->result();	
			}elseif($model=='n' && $color!='n' && $size=='n' && $user!='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND username='$user' ORDER BY date_time")->result();	
			}elseif($model!='n' && $color=='n' && $size=='n' && $user!='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND username='$user' ORDER BY date_time")->result();	
			}elseif($model=='n' && $color!='n' && $size!='n' && $user=='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND size='$size' ORDER BY date_time")->result();	
			}elseif($model!='n' && $color=='n' && $size=='n' && $user=='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' ORDER BY date_time")->result();	
			}elseif($model=='n' && $color!='n' && $size=='n' && $user=='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' ORDER BY date_time")->result();	
			}elseif($model=='n' && $color=='n' && $size!='n' && $user=='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND size='$size' ORDER BY date_time")->result();	
			}elseif($model=='n' && $color=='n' && $size=='n' && $user!='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND username='$user' ORDER BY date_time")->result();	
			}else{
				$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' ORDER BY date_time")->result();
			}
		}	
		$file_name=date('d-m-Y')."_Detail Daily";
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename={$file_name}.xls");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		$data['tanggal1']=$tanggal1;
		$data['tanggal2']=$tanggal2;
		$data['tipe']=$tipe;
		$this->load->view('excel_detail_daily',$data);
	}
	
	//print summary daily
	public function print_summary_daily($tanggal1,$tanggal2,$tipe,$tanggal){
		$data['username']=$this->session->userdata['username'];
		if($tipe=="receiving"){
			$data['detail']=$this->model_transaksi->custom_query
			("SELECT 'X' AS model, 'X' AS color, 'GRAND TOTAL' AS description, 
				SUM(CASE WHEN size = '10K' THEN +quantity END) AS 'data_size1', 
				SUM(CASE WHEN size = '10TK' THEN +quantity END) AS 'data_size2', 
				SUM(CASE WHEN size = '11K' THEN +quantity END) AS 'data_size3', 
				SUM(CASE WHEN size = '11TK' THEN +quantity END) AS 'data_size4', 
				SUM(CASE WHEN size = '12K' THEN +quantity END) AS 'data_size5', 
				SUM(CASE WHEN size = '12TK' THEN +quantity END) AS 'data_size6', 
				SUM(CASE WHEN size = '13K' THEN +quantity END) AS 'data_size7', 
				SUM(CASE WHEN size = '13TK' THEN +quantity END) AS 'data_size8', 
				SUM(CASE WHEN size = '1' THEN +quantity END) AS 'data_size9', 
				SUM(CASE WHEN size = '1T' THEN +quantity END) AS 'data_size10', 
				SUM(CASE WHEN size = '2' THEN +quantity END) AS 'data_size11', 
				SUM(CASE WHEN size = '2T' THEN +quantity END) AS 'data_size12', 
				SUM(CASE WHEN size = '3' THEN +quantity END) AS 'data_size13', 
				SUM(CASE WHEN size = '3T' THEN +quantity END) AS 'data_size14', 
				SUM(CASE WHEN size = '4' THEN +quantity END) AS 'data_size15', 
				SUM(CASE WHEN size = '4T' THEN +quantity END) AS 'data_size16', 
				SUM(CASE WHEN size = '5' THEN +quantity END) AS 'data_size17', 
				SUM(CASE WHEN size = '5T' THEN +quantity END) AS 'data_size18', 
				SUM(CASE WHEN size = '6' THEN +quantity END) AS 'data_size19', 
				SUM(CASE WHEN size = '6T' THEN +quantity END) AS 'data_size20', 
				SUM(CASE WHEN size = '7' THEN +quantity END) AS 'data_size21', 
				SUM(CASE WHEN size = '7T' THEN +quantity END) AS 'data_size22', 
				SUM(CASE WHEN size = '8' THEN +quantity END) AS 'data_size23', 
				SUM(CASE WHEN size = '8T' THEN +quantity END) AS 'data_size24', 
				SUM(CASE WHEN size = '9' THEN +quantity END) AS 'data_size25', 
				SUM(CASE WHEN size = '9T' THEN +quantity END) AS 'data_size26', 
				SUM(CASE WHEN size = '10' THEN +quantity END) AS 'data_size27', 
				SUM(CASE WHEN size = '10T' THEN +quantity END) AS 'data_size28', 
				SUM(CASE WHEN size = '11' THEN +quantity END) AS 'data_size29', 
				SUM(CASE WHEN size = '11T' THEN +quantity END) AS 'data_size30', 
				SUM(CASE WHEN size = '12' THEN +quantity END) AS 'data_size31', 
				SUM(CASE WHEN size = '12T' THEN +quantity END) AS 'data_size32', 
				SUM(CASE WHEN size = '13' THEN +quantity END) AS 'data_size33', 
				SUM(CASE WHEN size = '13T' THEN +quantity END) AS 'data_size34', 
				SUM(CASE WHEN size = '14' THEN +quantity END) AS 'data_size35', 
				SUM(CASE WHEN size = '14T' THEN +quantity END) AS 'data_size36', 
				SUM(CASE WHEN size = '15' THEN +quantity END) AS 'data_size37', 
				SUM(CASE WHEN size = '15T' THEN +quantity END) AS 'data_size38', 
				SUM(CASE WHEN size = '16' THEN +quantity END) AS 'data_size39', 
				SUM(CASE WHEN size = '16T' THEN +quantity END) AS 'data_size40', 
				SUM(CASE WHEN size = '17' THEN +quantity END) AS 'data_size41', 
				SUM(CASE WHEN size = '17T' THEN +quantity END) AS 'data_size42', 
				SUM(CASE WHEN size = '18' THEN +quantity END) AS 'data_size43', 
				SUM(CASE WHEN size = '18T' THEN +quantity END) AS 'data_size44', 
			SUM(quantity) AS TOTAL FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' UNION ALL SELECT model, color, description, 
				SUM(CASE WHEN size = '10K' THEN +quantity END) AS 'data_size1', 
				SUM(CASE WHEN size = '10TK' THEN +quantity END) AS 'data_size2', 
				SUM(CASE WHEN size = '11K' THEN +quantity END) AS 'data_size3', 
				SUM(CASE WHEN size = '11TK' THEN +quantity END) AS 'data_size4', 
				SUM(CASE WHEN size = '12K' THEN +quantity END) AS 'data_size5', 
				SUM(CASE WHEN size = '12TK' THEN +quantity END) AS 'data_size6', 
				SUM(CASE WHEN size = '13K' THEN +quantity END) AS 'data_size7', 
				SUM(CASE WHEN size = '13TK' THEN +quantity END) AS 'data_size8', 
				SUM(CASE WHEN size = '1' THEN +quantity END) AS 'data_size9', 
				SUM(CASE WHEN size = '1T' THEN +quantity END) AS 'data_size10', 
				SUM(CASE WHEN size = '2' THEN +quantity END) AS 'data_size11', 
				SUM(CASE WHEN size = '2T' THEN +quantity END) AS 'data_size12', 
				SUM(CASE WHEN size = '3' THEN +quantity END) AS 'data_size13', 
				SUM(CASE WHEN size = '3T' THEN +quantity END) AS 'data_size14', 
				SUM(CASE WHEN size = '4' THEN +quantity END) AS 'data_size15', 
				SUM(CASE WHEN size = '4T' THEN +quantity END) AS 'data_size16', 
				SUM(CASE WHEN size = '5' THEN +quantity END) AS 'data_size17', 
				SUM(CASE WHEN size = '5T' THEN +quantity END) AS 'data_size18', 
				SUM(CASE WHEN size = '6' THEN +quantity END) AS 'data_size19', 
				SUM(CASE WHEN size = '6T' THEN +quantity END) AS 'data_size20', 
				SUM(CASE WHEN size = '7' THEN +quantity END) AS 'data_size21', 
				SUM(CASE WHEN size = '7T' THEN +quantity END) AS 'data_size22', 
				SUM(CASE WHEN size = '8' THEN +quantity END) AS 'data_size23', 
				SUM(CASE WHEN size = '8T' THEN +quantity END) AS 'data_size24', 
				SUM(CASE WHEN size = '9' THEN +quantity END) AS 'data_size25', 
				SUM(CASE WHEN size = '9T' THEN +quantity END) AS 'data_size26', 
				SUM(CASE WHEN size = '10' THEN +quantity END) AS 'data_size27', 
				SUM(CASE WHEN size = '10T' THEN +quantity END) AS 'data_size28', 
				SUM(CASE WHEN size = '11' THEN +quantity END) AS 'data_size29', 
				SUM(CASE WHEN size = '11T' THEN +quantity END) AS 'data_size30', 
				SUM(CASE WHEN size = '12' THEN +quantity END) AS 'data_size31', 
				SUM(CASE WHEN size = '12T' THEN +quantity END) AS 'data_size32', 
				SUM(CASE WHEN size = '13' THEN +quantity END) AS 'data_size33', 
				SUM(CASE WHEN size = '13T' THEN +quantity END) AS 'data_size34', 
				SUM(CASE WHEN size = '14' THEN +quantity END) AS 'data_size35', 
				SUM(CASE WHEN size = '14T' THEN +quantity END) AS 'data_size36', 
				SUM(CASE WHEN size = '15' THEN +quantity END) AS 'data_size37', 
				SUM(CASE WHEN size = '15T' THEN +quantity END) AS 'data_size38', 
				SUM(CASE WHEN size = '16' THEN +quantity END) AS 'data_size39', 
				SUM(CASE WHEN size = '16T' THEN +quantity END) AS 'data_size40', 
				SUM(CASE WHEN size = '17' THEN +quantity END) AS 'data_size41', 
				SUM(CASE WHEN size = '17T' THEN +quantity END) AS 'data_size42', 
				SUM(CASE WHEN size = '18' THEN +quantity END) AS 'data_size43', 
				SUM(CASE WHEN size = '18T' THEN +quantity END) AS 'data_size44', 
			SUM(quantity) AS TOTAL FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' GROUP BY model, color, description ORDER BY model, color, description ASC")->result();
		}elseif($tipe=="shipping"){
			$data['detail']=$this->model_transaksi->custom_query
			("SELECT 'X' AS model, 'X' AS color, 'GRAND TOTAL' AS description, 
				SUM(CASE WHEN size = '10K' THEN +quantity END) AS 'data_size1', 
				SUM(CASE WHEN size = '10TK' THEN +quantity END) AS 'data_size2', 
				SUM(CASE WHEN size = '11K' THEN +quantity END) AS 'data_size3', 
				SUM(CASE WHEN size = '11TK' THEN +quantity END) AS 'data_size4', 
				SUM(CASE WHEN size = '12K' THEN +quantity END) AS 'data_size5', 
				SUM(CASE WHEN size = '12TK' THEN +quantity END) AS 'data_size6', 
				SUM(CASE WHEN size = '13K' THEN +quantity END) AS 'data_size7', 
				SUM(CASE WHEN size = '13TK' THEN +quantity END) AS 'data_size8', 
				SUM(CASE WHEN size = '1' THEN +quantity END) AS 'data_size9', 
				SUM(CASE WHEN size = '1T' THEN +quantity END) AS 'data_size10', 
				SUM(CASE WHEN size = '2' THEN +quantity END) AS 'data_size11', 
				SUM(CASE WHEN size = '2T' THEN +quantity END) AS 'data_size12', 
				SUM(CASE WHEN size = '3' THEN +quantity END) AS 'data_size13', 
				SUM(CASE WHEN size = '3T' THEN +quantity END) AS 'data_size14', 
				SUM(CASE WHEN size = '4' THEN +quantity END) AS 'data_size15', 
				SUM(CASE WHEN size = '4T' THEN +quantity END) AS 'data_size16', 
				SUM(CASE WHEN size = '5' THEN +quantity END) AS 'data_size17', 
				SUM(CASE WHEN size = '5T' THEN +quantity END) AS 'data_size18', 
				SUM(CASE WHEN size = '6' THEN +quantity END) AS 'data_size19', 
				SUM(CASE WHEN size = '6T' THEN +quantity END) AS 'data_size20', 
				SUM(CASE WHEN size = '7' THEN +quantity END) AS 'data_size21', 
				SUM(CASE WHEN size = '7T' THEN +quantity END) AS 'data_size22', 
				SUM(CASE WHEN size = '8' THEN +quantity END) AS 'data_size23', 
				SUM(CASE WHEN size = '8T' THEN +quantity END) AS 'data_size24', 
				SUM(CASE WHEN size = '9' THEN +quantity END) AS 'data_size25', 
				SUM(CASE WHEN size = '9T' THEN +quantity END) AS 'data_size26', 
				SUM(CASE WHEN size = '10' THEN +quantity END) AS 'data_size27', 
				SUM(CASE WHEN size = '10T' THEN +quantity END) AS 'data_size28', 
				SUM(CASE WHEN size = '11' THEN +quantity END) AS 'data_size29', 
				SUM(CASE WHEN size = '11T' THEN +quantity END) AS 'data_size30', 
				SUM(CASE WHEN size = '12' THEN +quantity END) AS 'data_size31', 
				SUM(CASE WHEN size = '12T' THEN +quantity END) AS 'data_size32', 
				SUM(CASE WHEN size = '13' THEN +quantity END) AS 'data_size33', 
				SUM(CASE WHEN size = '13T' THEN +quantity END) AS 'data_size34', 
				SUM(CASE WHEN size = '14' THEN +quantity END) AS 'data_size35', 
				SUM(CASE WHEN size = '14T' THEN +quantity END) AS 'data_size36', 
				SUM(CASE WHEN size = '15' THEN +quantity END) AS 'data_size37', 
				SUM(CASE WHEN size = '15T' THEN +quantity END) AS 'data_size38', 
				SUM(CASE WHEN size = '16' THEN +quantity END) AS 'data_size39', 
				SUM(CASE WHEN size = '16T' THEN +quantity END) AS 'data_size40', 
				SUM(CASE WHEN size = '17' THEN +quantity END) AS 'data_size41', 
				SUM(CASE WHEN size = '17T' THEN +quantity END) AS 'data_size42', 
				SUM(CASE WHEN size = '18' THEN +quantity END) AS 'data_size43', 
				SUM(CASE WHEN size = '18T' THEN +quantity END) AS 'data_size44', 
			SUM(quantity) AS TOTAL FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' UNION ALL SELECT model, color, description, 
				SUM(CASE WHEN size = '10K' THEN +quantity END) AS 'data_size1', 
				SUM(CASE WHEN size = '10TK' THEN +quantity END) AS 'data_size2', 
				SUM(CASE WHEN size = '11K' THEN +quantity END) AS 'data_size3', 
				SUM(CASE WHEN size = '11TK' THEN +quantity END) AS 'data_size4', 
				SUM(CASE WHEN size = '12K' THEN +quantity END) AS 'data_size5', 
				SUM(CASE WHEN size = '12TK' THEN +quantity END) AS 'data_size6', 
				SUM(CASE WHEN size = '13K' THEN +quantity END) AS 'data_size7', 
				SUM(CASE WHEN size = '13TK' THEN +quantity END) AS 'data_size8', 
				SUM(CASE WHEN size = '1' THEN +quantity END) AS 'data_size9', 
				SUM(CASE WHEN size = '1T' THEN +quantity END) AS 'data_size10', 
				SUM(CASE WHEN size = '2' THEN +quantity END) AS 'data_size11', 
				SUM(CASE WHEN size = '2T' THEN +quantity END) AS 'data_size12', 
				SUM(CASE WHEN size = '3' THEN +quantity END) AS 'data_size13', 
				SUM(CASE WHEN size = '3T' THEN +quantity END) AS 'data_size14', 
				SUM(CASE WHEN size = '4' THEN +quantity END) AS 'data_size15', 
				SUM(CASE WHEN size = '4T' THEN +quantity END) AS 'data_size16', 
				SUM(CASE WHEN size = '5' THEN +quantity END) AS 'data_size17', 
				SUM(CASE WHEN size = '5T' THEN +quantity END) AS 'data_size18', 
				SUM(CASE WHEN size = '6' THEN +quantity END) AS 'data_size19', 
				SUM(CASE WHEN size = '6T' THEN +quantity END) AS 'data_size20', 
				SUM(CASE WHEN size = '7' THEN +quantity END) AS 'data_size21', 
				SUM(CASE WHEN size = '7T' THEN +quantity END) AS 'data_size22', 
				SUM(CASE WHEN size = '8' THEN +quantity END) AS 'data_size23', 
				SUM(CASE WHEN size = '8T' THEN +quantity END) AS 'data_size24', 
				SUM(CASE WHEN size = '9' THEN +quantity END) AS 'data_size25', 
				SUM(CASE WHEN size = '9T' THEN +quantity END) AS 'data_size26', 
				SUM(CASE WHEN size = '10' THEN +quantity END) AS 'data_size27', 
				SUM(CASE WHEN size = '10T' THEN +quantity END) AS 'data_size28', 
				SUM(CASE WHEN size = '11' THEN +quantity END) AS 'data_size29', 
				SUM(CASE WHEN size = '11T' THEN +quantity END) AS 'data_size30', 
				SUM(CASE WHEN size = '12' THEN +quantity END) AS 'data_size31', 
				SUM(CASE WHEN size = '12T' THEN +quantity END) AS 'data_size32', 
				SUM(CASE WHEN size = '13' THEN +quantity END) AS 'data_size33', 
				SUM(CASE WHEN size = '13T' THEN +quantity END) AS 'data_size34', 
				SUM(CASE WHEN size = '14' THEN +quantity END) AS 'data_size35', 
				SUM(CASE WHEN size = '14T' THEN +quantity END) AS 'data_size36', 
				SUM(CASE WHEN size = '15' THEN +quantity END) AS 'data_size37', 
				SUM(CASE WHEN size = '15T' THEN +quantity END) AS 'data_size38', 
				SUM(CASE WHEN size = '16' THEN +quantity END) AS 'data_size39', 
				SUM(CASE WHEN size = '16T' THEN +quantity END) AS 'data_size40', 
				SUM(CASE WHEN size = '17' THEN +quantity END) AS 'data_size41', 
				SUM(CASE WHEN size = '17T' THEN +quantity END) AS 'data_size42', 
				SUM(CASE WHEN size = '18' THEN +quantity END) AS 'data_size43', 
				SUM(CASE WHEN size = '18T' THEN +quantity END) AS 'data_size44', 
			SUM(quantity) AS TOTAL FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' GROUP BY model, color, description ORDER BY model, color, description ASC")->result();
		}else{
			$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND original_barcode = '0' ORDER BY date_time")->result();
		}
		$file_name=date('d-m-Y')."_Summary Daily";
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename={$file_name}.xls");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		$data['tanggal1']=$tanggal1;
		$data['tanggal2']=$tanggal2;
		$data['tipe']=$tipe;
		$data['tanggal']=$tanggal;
		$this->load->view('excel_summary_daily',$data);
	}
	
	//print hourly daily
	public function print_hourly_daily($tanggal1,$tanggal2,$tipe,$tanggal){
		$data['username']=$this->session->userdata['username'];
		if($tipe=="receiving"){
			$data['detail']=$this->model_transaksi->custom_query
			("SELECT 'XGRAND TOTAL' AS item,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 07:00:00' AND '$tanggal1 07:59:59' THEN +quantity END) AS data_size1,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 08:00:00' AND '$tanggal1 08:59:59' THEN +quantity END) AS data_size2,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 09:00:00' AND '$tanggal1 09:59:59' THEN +quantity END) AS data_size3,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 10:00:00' AND '$tanggal1 10:59:59' THEN +quantity END) AS data_size4,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 11:00:00' AND '$tanggal1 11:59:59' THEN +quantity END) AS data_size5,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 12:00:00' AND '$tanggal1 12:59:59' THEN +quantity END) AS data_size6,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 13:00:00' AND '$tanggal1 13:59:59' THEN +quantity END) AS data_size7,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 14:00:00' AND '$tanggal1 14:59:59' THEN +quantity END) AS data_size8,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 15:00:00' AND '$tanggal1 15:59:59' THEN +quantity END) AS data_size9,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 16:00:00' AND '$tanggal1 16:59:59' THEN +quantity END) AS data_size10,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 17:00:00' AND '$tanggal1 17:59:59' THEN +quantity END) AS data_size11,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 18:00:00' AND '$tanggal1 18:59:59' THEN +quantity END) AS data_size12,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 19:00:00' AND '$tanggal1 19:59:59' THEN +quantity END) AS data_size13,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 20:00:00' AND '$tanggal1 20:59:59' THEN +quantity END) AS data_size14,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 21:00:00' AND '$tanggal1 21:59:59' THEN +quantity END) AS data_size15,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 22:00:00' AND '$tanggal1 22:59:59' THEN +quantity END) AS data_size16,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 23:00:00' AND '$tanggal1 23:59:59' THEN +quantity END) AS data_size17,
				SUM(CASE WHEN date_time BETWEEN '$tanggal2 00:00:00' AND '$tanggal2 00:59:59' THEN +quantity END) AS data_size18,
				SUM(CASE WHEN date_time BETWEEN '$tanggal2 01:00:00' AND '$tanggal2 01:59:59' THEN +quantity END) AS data_size19,
				SUM(CASE WHEN date_time BETWEEN '$tanggal2 02:00:00' AND '$tanggal2 02:59:59' THEN +quantity END) AS data_size20,
				SUM(CASE WHEN date_time BETWEEN '$tanggal2 03:00:00' AND '$tanggal2 03:59:59' THEN +quantity END) AS data_size21,
				SUM(CASE WHEN date_time BETWEEN '$tanggal2 04:00:00' AND '$tanggal2 04:59:59' THEN +quantity END) AS data_size22,
				SUM(CASE WHEN date_time BETWEEN '$tanggal2 05:00:00' AND '$tanggal2 05:59:59' THEN +quantity END) AS data_size23,
				SUM(CASE WHEN date_time BETWEEN '$tanggal2 06:00:00' AND '$tanggal2 06:59:59' THEN +quantity END) AS data_size24,
				SUM(quantity) AS TOTAL FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND production = 'PT HSK REMBANG'
				UNION ALL
			SELECT item,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 07:00:00' AND '$tanggal1 07:59:59' THEN +quantity END) AS data_size1,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 08:00:00' AND '$tanggal1 08:59:59' THEN +quantity END) AS data_size2,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 09:00:00' AND '$tanggal1 09:59:59' THEN +quantity END) AS data_size3,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 10:00:00' AND '$tanggal1 10:59:59' THEN +quantity END) AS data_size4,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 11:00:00' AND '$tanggal1 11:59:59' THEN +quantity END) AS data_size5,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 12:00:00' AND '$tanggal1 12:59:59' THEN +quantity END) AS data_size6,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 13:00:00' AND '$tanggal1 13:59:59' THEN +quantity END) AS data_size7,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 14:00:00' AND '$tanggal1 14:59:59' THEN +quantity END) AS data_size8,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 15:00:00' AND '$tanggal1 15:59:59' THEN +quantity END) AS data_size9,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 16:00:00' AND '$tanggal1 16:59:59' THEN +quantity END) AS data_size10,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 17:00:00' AND '$tanggal1 17:59:59' THEN +quantity END) AS data_size11,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 18:00:00' AND '$tanggal1 18:59:59' THEN +quantity END) AS data_size12,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 19:00:00' AND '$tanggal1 19:59:59' THEN +quantity END) AS data_size13,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 20:00:00' AND '$tanggal1 20:59:59' THEN +quantity END) AS data_size14,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 21:00:00' AND '$tanggal1 21:59:59' THEN +quantity END) AS data_size15,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 22:00:00' AND '$tanggal1 22:59:59' THEN +quantity END) AS data_size16,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 23:00:00' AND '$tanggal1 23:59:59' THEN +quantity END) AS data_size17,
				SUM(CASE WHEN date_time BETWEEN '$tanggal2 00:00:00' AND '$tanggal2 00:59:59' THEN +quantity END) AS data_size18,
				SUM(CASE WHEN date_time BETWEEN '$tanggal2 01:00:00' AND '$tanggal2 01:59:59' THEN +quantity END) AS data_size19,
				SUM(CASE WHEN date_time BETWEEN '$tanggal2 02:00:00' AND '$tanggal2 02:59:59' THEN +quantity END) AS data_size20,
				SUM(CASE WHEN date_time BETWEEN '$tanggal2 03:00:00' AND '$tanggal2 03:59:59' THEN +quantity END) AS data_size21,
				SUM(CASE WHEN date_time BETWEEN '$tanggal2 04:00:00' AND '$tanggal2 04:59:59' THEN +quantity END) AS data_size22,
				SUM(CASE WHEN date_time BETWEEN '$tanggal2 05:00:00' AND '$tanggal2 05:59:59' THEN +quantity END) AS data_size23,
				SUM(CASE WHEN date_time BETWEEN '$tanggal2 06:00:00' AND '$tanggal2 06:59:59' THEN +quantity END) AS data_size24,
				SUM(quantity) AS TOTAL FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND production = 'PT HSK REMBANG' GROUP BY item ORDER BY item ASC")->result();
		}elseif($tipe=="shipping"){
			$data['detail']=$this->model_transaksi->custom_query
			("SELECT 'XGRAND TOTAL' AS item,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 07:00:00' AND '$tanggal1 07:59:59' THEN +quantity END) AS data_size1,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 08:00:00' AND '$tanggal1 08:59:59' THEN +quantity END) AS data_size2,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 09:00:00' AND '$tanggal1 09:59:59' THEN +quantity END) AS data_size3,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 10:00:00' AND '$tanggal1 10:59:59' THEN +quantity END) AS data_size4,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 11:00:00' AND '$tanggal1 11:59:59' THEN +quantity END) AS data_size5,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 12:00:00' AND '$tanggal1 12:59:59' THEN +quantity END) AS data_size6,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 13:00:00' AND '$tanggal1 13:59:59' THEN +quantity END) AS data_size7,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 14:00:00' AND '$tanggal1 14:59:59' THEN +quantity END) AS data_size8,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 15:00:00' AND '$tanggal1 15:59:59' THEN +quantity END) AS data_size9,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 16:00:00' AND '$tanggal1 16:59:59' THEN +quantity END) AS data_size10,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 17:00:00' AND '$tanggal1 17:59:59' THEN +quantity END) AS data_size11,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 18:00:00' AND '$tanggal1 18:59:59' THEN +quantity END) AS data_size12,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 19:00:00' AND '$tanggal1 19:59:59' THEN +quantity END) AS data_size13,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 20:00:00' AND '$tanggal1 20:59:59' THEN +quantity END) AS data_size14,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 21:00:00' AND '$tanggal1 21:59:59' THEN +quantity END) AS data_size15,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 22:00:00' AND '$tanggal1 22:59:59' THEN +quantity END) AS data_size16,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 23:00:00' AND '$tanggal1 23:59:59' THEN +quantity END) AS data_size17,
				SUM(CASE WHEN date_time BETWEEN '$tanggal2 00:00:00' AND '$tanggal2 00:59:59' THEN +quantity END) AS data_size18,
				SUM(CASE WHEN date_time BETWEEN '$tanggal2 01:00:00' AND '$tanggal2 01:59:59' THEN +quantity END) AS data_size19,
				SUM(CASE WHEN date_time BETWEEN '$tanggal2 02:00:00' AND '$tanggal2 02:59:59' THEN +quantity END) AS data_size20,
				SUM(CASE WHEN date_time BETWEEN '$tanggal2 03:00:00' AND '$tanggal2 03:59:59' THEN +quantity END) AS data_size21,
				SUM(CASE WHEN date_time BETWEEN '$tanggal2 04:00:00' AND '$tanggal2 04:59:59' THEN +quantity END) AS data_size22,
				SUM(CASE WHEN date_time BETWEEN '$tanggal2 05:00:00' AND '$tanggal2 05:59:59' THEN +quantity END) AS data_size23,
				SUM(CASE WHEN date_time BETWEEN '$tanggal2 06:00:00' AND '$tanggal2 06:59:59' THEN +quantity END) AS data_size24,
				SUM(quantity) AS TOTAL FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND production = 'PT HSK REMBANG'
				UNION ALL
			SELECT item,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 07:00:00' AND '$tanggal1 07:59:59' THEN +quantity END) AS data_size1,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 08:00:00' AND '$tanggal1 08:59:59' THEN +quantity END) AS data_size2,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 09:00:00' AND '$tanggal1 09:59:59' THEN +quantity END) AS data_size3,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 10:00:00' AND '$tanggal1 10:59:59' THEN +quantity END) AS data_size4,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 11:00:00' AND '$tanggal1 11:59:59' THEN +quantity END) AS data_size5,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 12:00:00' AND '$tanggal1 12:59:59' THEN +quantity END) AS data_size6,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 13:00:00' AND '$tanggal1 13:59:59' THEN +quantity END) AS data_size7,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 14:00:00' AND '$tanggal1 14:59:59' THEN +quantity END) AS data_size8,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 15:00:00' AND '$tanggal1 15:59:59' THEN +quantity END) AS data_size9,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 16:00:00' AND '$tanggal1 16:59:59' THEN +quantity END) AS data_size10,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 17:00:00' AND '$tanggal1 17:59:59' THEN +quantity END) AS data_size11,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 18:00:00' AND '$tanggal1 18:59:59' THEN +quantity END) AS data_size12,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 19:00:00' AND '$tanggal1 19:59:59' THEN +quantity END) AS data_size13,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 20:00:00' AND '$tanggal1 20:59:59' THEN +quantity END) AS data_size14,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 21:00:00' AND '$tanggal1 21:59:59' THEN +quantity END) AS data_size15,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 22:00:00' AND '$tanggal1 22:59:59' THEN +quantity END) AS data_size16,
				SUM(CASE WHEN date_time BETWEEN '$tanggal1 23:00:00' AND '$tanggal1 23:59:59' THEN +quantity END) AS data_size17,
				SUM(CASE WHEN date_time BETWEEN '$tanggal2 00:00:00' AND '$tanggal2 00:59:59' THEN +quantity END) AS data_size18,
				SUM(CASE WHEN date_time BETWEEN '$tanggal2 01:00:00' AND '$tanggal2 01:59:59' THEN +quantity END) AS data_size19,
				SUM(CASE WHEN date_time BETWEEN '$tanggal2 02:00:00' AND '$tanggal2 02:59:59' THEN +quantity END) AS data_size20,
				SUM(CASE WHEN date_time BETWEEN '$tanggal2 03:00:00' AND '$tanggal2 03:59:59' THEN +quantity END) AS data_size21,
				SUM(CASE WHEN date_time BETWEEN '$tanggal2 04:00:00' AND '$tanggal2 04:59:59' THEN +quantity END) AS data_size22,
				SUM(CASE WHEN date_time BETWEEN '$tanggal2 05:00:00' AND '$tanggal2 05:59:59' THEN +quantity END) AS data_size23,
				SUM(CASE WHEN date_time BETWEEN '$tanggal2 06:00:00' AND '$tanggal2 06:59:59' THEN +quantity END) AS data_size24,
				SUM(quantity) AS TOTAL FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND production = 'PT HSK REMBANG' GROUP BY item ORDER BY item ASC")->result();
		}else{
			$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND original_barcode = '0' ORDER BY date_time")->result();
		}
		$file_name=date('d-m-Y')."_Hourly Daily";
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename={$file_name}.xls");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		$data['tanggal1']=$tanggal1;
		$data['tanggal2']=$tanggal2;
		$data['tipe']=$tipe;
		$data['tanggal']=$tanggal;
		$this->load->view('excel_hourly_daily',$data);
	}
	
	//print detail monthly
	public function print_detail_monthly($tanggal1,$tanggal2,$tipe,$model,$color,$size,$user){
		$data['username']=$this->session->userdata['username'];
		$model=preg_replace('/%20/', ' ', $model);
		$color=preg_replace('/%20/', ' ', $color);
		$size=preg_replace('/%20/', ' ', $size);
		$user=preg_replace('/%20/', ' ', $user);
		if($tipe=="receiving"){
			if($model!='n' && $color!='n' && $size!='n' && $user!='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND size='$size' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();
			}elseif($model!='n' && $color!='n' && $size!='n' && $user=='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND size='$size' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
			}elseif($model!='n' && $color!='n' && $size=='n' && $user!='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();
			}elseif($model!='n' && $color=='n' && $size!='n' && $user!='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND size='$size' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
			}elseif($model=='n' && $color!='n' && $size!='n' && $user!='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND size='$size' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
			}elseif($model!='n' && $color!='n' && $size=='n' && $user=='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
			}elseif($model=='n' && $color=='n' && $size!='n' && $user!='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND size='$size' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
			}elseif($model!='n' && $color=='n' && $size!='n' && $user=='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND size='$size' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
			}elseif($model=='n' && $color!='n' && $size=='n' && $user!='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
			}elseif($model!='n' && $color=='n' && $size=='n' && $user!='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
			}elseif($model=='n' && $color!='n' && $size!='n' && $user=='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND size='$size' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
			}elseif($model!='n' && $color=='n' && $size=='n' && $user=='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
			}elseif($model=='n' && $color!='n' && $size=='n' && $user=='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
			}elseif($model=='n' && $color=='n' && $size!='n' && $user=='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND size='$size' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
			}elseif($model=='n' && $color=='n' && $size=='n' && $user!='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
			}else{
				$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();
			}
		}elseif($tipe="shipping") {
			if($model!='n' && $color!='n' && $size!='n' && $user!='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND size='$size' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();
			}elseif($model!='n' && $color!='n' && $size!='n' && $user=='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND size='$size' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
			}elseif($model!='n' && $color!='n' && $size=='n' && $user!='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();
			}elseif($model!='n' && $color=='n' && $size!='n' && $user!='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND size='$size' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
			}elseif($model=='n' && $color!='n' && $size!='n' && $user!='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND size='$size' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
			}elseif($model!='n' && $color!='n' && $size=='n' && $user=='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND color='$color' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
			}elseif($model=='n' && $color=='n' && $size!='n' && $user!='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND size='$size' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
			}elseif($model!='n' && $color=='n' && $size!='n' && $user=='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND size='$size' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
			}elseif($model=='n' && $color!='n' && $size=='n' && $user!='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
			}elseif($model!='n' && $color=='n' && $size=='n' && $user!='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
			}elseif($model=='n' && $color!='n' && $size!='n' && $user=='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND size='$size' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
			}elseif($model!='n' && $color=='n' && $size=='n' && $user=='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND model_code='$model' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
			}elseif($model=='n' && $color!='n' && $size=='n' && $user=='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND color='$color' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
			}elseif($model=='n' && $color=='n' && $size!='n' && $user=='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND size='$size' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
			}elseif($model=='n' && $color=='n' && $size=='n' && $user!='n'){
				$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND username='$user' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();	
			}else{
				$data['detail']=$this->model_transaksi->custom_query("SELECT production, brand, model, color, size, description, SUM(Quantity) AS total FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND description IN ('INCOME','SAMPLE') GROUP BY production, brand, model, color, size, description ORDER BY model")->result();
			}
		}	
		$file_name=date('d-m-Y')."_Detail Monthly";
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename={$file_name}.xls");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		$data['tanggal1']=$tanggal1;
		$data['tanggal2']=$tanggal2;
		$data['tipe']=$tipe;
		$this->load->view('excel_detail_monthly',$data);
	}
	
	//print summary monthly
	public function print_summary_monthly($tanggal1,$tanggal2,$tipe,$tanggal){
		$data['username']=$this->session->userdata['username'];
		if($tipe=="receiving"){
			$data['detail']=$this->model_transaksi->custom_query
			("SELECT 'X' AS model, 'X' AS color, 'GRAND TOTAL' AS description, 
				SUM(CASE WHEN size = '10K' THEN +quantity END) AS 'data_size1', 
				SUM(CASE WHEN size = '10TK' THEN +quantity END) AS 'data_size2', 
				SUM(CASE WHEN size = '11K' THEN +quantity END) AS 'data_size3', 
				SUM(CASE WHEN size = '11TK' THEN +quantity END) AS 'data_size4', 
				SUM(CASE WHEN size = '12K' THEN +quantity END) AS 'data_size5', 
				SUM(CASE WHEN size = '12TK' THEN +quantity END) AS 'data_size6', 
				SUM(CASE WHEN size = '13K' THEN +quantity END) AS 'data_size7', 
				SUM(CASE WHEN size = '13TK' THEN +quantity END) AS 'data_size8', 
				SUM(CASE WHEN size = '1' THEN +quantity END) AS 'data_size9', 
				SUM(CASE WHEN size = '1T' THEN +quantity END) AS 'data_size10', 
				SUM(CASE WHEN size = '2' THEN +quantity END) AS 'data_size11', 
				SUM(CASE WHEN size = '2T' THEN +quantity END) AS 'data_size12', 
				SUM(CASE WHEN size = '3' THEN +quantity END) AS 'data_size13', 
				SUM(CASE WHEN size = '3T' THEN +quantity END) AS 'data_size14', 
				SUM(CASE WHEN size = '4' THEN +quantity END) AS 'data_size15', 
				SUM(CASE WHEN size = '4T' THEN +quantity END) AS 'data_size16', 
				SUM(CASE WHEN size = '5' THEN +quantity END) AS 'data_size17', 
				SUM(CASE WHEN size = '5T' THEN +quantity END) AS 'data_size18', 
				SUM(CASE WHEN size = '6' THEN +quantity END) AS 'data_size19', 
				SUM(CASE WHEN size = '6T' THEN +quantity END) AS 'data_size20', 
				SUM(CASE WHEN size = '7' THEN +quantity END) AS 'data_size21', 
				SUM(CASE WHEN size = '7T' THEN +quantity END) AS 'data_size22', 
				SUM(CASE WHEN size = '8' THEN +quantity END) AS 'data_size23', 
				SUM(CASE WHEN size = '8T' THEN +quantity END) AS 'data_size24', 
				SUM(CASE WHEN size = '9' THEN +quantity END) AS 'data_size25', 
				SUM(CASE WHEN size = '9T' THEN +quantity END) AS 'data_size26', 
				SUM(CASE WHEN size = '10' THEN +quantity END) AS 'data_size27', 
				SUM(CASE WHEN size = '10T' THEN +quantity END) AS 'data_size28', 
				SUM(CASE WHEN size = '11' THEN +quantity END) AS 'data_size29', 
				SUM(CASE WHEN size = '11T' THEN +quantity END) AS 'data_size30', 
				SUM(CASE WHEN size = '12' THEN +quantity END) AS 'data_size31', 
				SUM(CASE WHEN size = '12T' THEN +quantity END) AS 'data_size32', 
				SUM(CASE WHEN size = '13' THEN +quantity END) AS 'data_size33', 
				SUM(CASE WHEN size = '13T' THEN +quantity END) AS 'data_size34', 
				SUM(CASE WHEN size = '14' THEN +quantity END) AS 'data_size35', 
				SUM(CASE WHEN size = '14T' THEN +quantity END) AS 'data_size36', 
				SUM(CASE WHEN size = '15' THEN +quantity END) AS 'data_size37', 
				SUM(CASE WHEN size = '15T' THEN +quantity END) AS 'data_size38', 
				SUM(CASE WHEN size = '16' THEN +quantity END) AS 'data_size39', 
				SUM(CASE WHEN size = '16T' THEN +quantity END) AS 'data_size40', 
				SUM(CASE WHEN size = '17' THEN +quantity END) AS 'data_size41', 
				SUM(CASE WHEN size = '17T' THEN +quantity END) AS 'data_size42', 
				SUM(CASE WHEN size = '18' THEN +quantity END) AS 'data_size43', 
				SUM(CASE WHEN size = '18T' THEN +quantity END) AS 'data_size44', 
			SUM(quantity) AS TOTAL FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND description IN ('INCOME','SAMPLE') UNION ALL SELECT model, color, description, 
				SUM(CASE WHEN size = '10K' THEN +quantity END) AS 'data_size1', 
				SUM(CASE WHEN size = '10TK' THEN +quantity END) AS 'data_size2', 
				SUM(CASE WHEN size = '11K' THEN +quantity END) AS 'data_size3', 
				SUM(CASE WHEN size = '11TK' THEN +quantity END) AS 'data_size4', 
				SUM(CASE WHEN size = '12K' THEN +quantity END) AS 'data_size5', 
				SUM(CASE WHEN size = '12TK' THEN +quantity END) AS 'data_size6', 
				SUM(CASE WHEN size = '13K' THEN +quantity END) AS 'data_size7', 
				SUM(CASE WHEN size = '13TK' THEN +quantity END) AS 'data_size8', 
				SUM(CASE WHEN size = '1' THEN +quantity END) AS 'data_size9', 
				SUM(CASE WHEN size = '1T' THEN +quantity END) AS 'data_size10', 
				SUM(CASE WHEN size = '2' THEN +quantity END) AS 'data_size11', 
				SUM(CASE WHEN size = '2T' THEN +quantity END) AS 'data_size12', 
				SUM(CASE WHEN size = '3' THEN +quantity END) AS 'data_size13', 
				SUM(CASE WHEN size = '3T' THEN +quantity END) AS 'data_size14', 
				SUM(CASE WHEN size = '4' THEN +quantity END) AS 'data_size15', 
				SUM(CASE WHEN size = '4T' THEN +quantity END) AS 'data_size16', 
				SUM(CASE WHEN size = '5' THEN +quantity END) AS 'data_size17', 
				SUM(CASE WHEN size = '5T' THEN +quantity END) AS 'data_size18', 
				SUM(CASE WHEN size = '6' THEN +quantity END) AS 'data_size19', 
				SUM(CASE WHEN size = '6T' THEN +quantity END) AS 'data_size20', 
				SUM(CASE WHEN size = '7' THEN +quantity END) AS 'data_size21', 
				SUM(CASE WHEN size = '7T' THEN +quantity END) AS 'data_size22', 
				SUM(CASE WHEN size = '8' THEN +quantity END) AS 'data_size23', 
				SUM(CASE WHEN size = '8T' THEN +quantity END) AS 'data_size24', 
				SUM(CASE WHEN size = '9' THEN +quantity END) AS 'data_size25', 
				SUM(CASE WHEN size = '9T' THEN +quantity END) AS 'data_size26', 
				SUM(CASE WHEN size = '10' THEN +quantity END) AS 'data_size27', 
				SUM(CASE WHEN size = '10T' THEN +quantity END) AS 'data_size28', 
				SUM(CASE WHEN size = '11' THEN +quantity END) AS 'data_size29', 
				SUM(CASE WHEN size = '11T' THEN +quantity END) AS 'data_size30', 
				SUM(CASE WHEN size = '12' THEN +quantity END) AS 'data_size31', 
				SUM(CASE WHEN size = '12T' THEN +quantity END) AS 'data_size32', 
				SUM(CASE WHEN size = '13' THEN +quantity END) AS 'data_size33', 
				SUM(CASE WHEN size = '13T' THEN +quantity END) AS 'data_size34', 
				SUM(CASE WHEN size = '14' THEN +quantity END) AS 'data_size35', 
				SUM(CASE WHEN size = '14T' THEN +quantity END) AS 'data_size36', 
				SUM(CASE WHEN size = '15' THEN +quantity END) AS 'data_size37', 
				SUM(CASE WHEN size = '15T' THEN +quantity END) AS 'data_size38', 
				SUM(CASE WHEN size = '16' THEN +quantity END) AS 'data_size39', 
				SUM(CASE WHEN size = '16T' THEN +quantity END) AS 'data_size40', 
				SUM(CASE WHEN size = '17' THEN +quantity END) AS 'data_size41', 
				SUM(CASE WHEN size = '17T' THEN +quantity END) AS 'data_size42', 
				SUM(CASE WHEN size = '18' THEN +quantity END) AS 'data_size43', 
				SUM(CASE WHEN size = '18T' THEN +quantity END) AS 'data_size44', 
			SUM(quantity) AS TOTAL FROM data_receiving WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND description IN ('INCOME','SAMPLE') GROUP BY model, color, description ORDER BY model, color, description ASC")->result();		
		}elseif($tipe=="shipping"){
			$data['detail']=$this->model_transaksi->custom_query
			("SELECT 'X' AS model, 'X' AS color, 'GRAND TOTAL' AS description, 
				SUM(CASE WHEN size = '10K' THEN +quantity END) AS 'data_size1', 
				SUM(CASE WHEN size = '10TK' THEN +quantity END) AS 'data_size2', 
				SUM(CASE WHEN size = '11K' THEN +quantity END) AS 'data_size3', 
				SUM(CASE WHEN size = '11TK' THEN +quantity END) AS 'data_size4', 
				SUM(CASE WHEN size = '12K' THEN +quantity END) AS 'data_size5', 
				SUM(CASE WHEN size = '12TK' THEN +quantity END) AS 'data_size6', 
				SUM(CASE WHEN size = '13K' THEN +quantity END) AS 'data_size7', 
				SUM(CASE WHEN size = '13TK' THEN +quantity END) AS 'data_size8', 
				SUM(CASE WHEN size = '1' THEN +quantity END) AS 'data_size9', 
				SUM(CASE WHEN size = '1T' THEN +quantity END) AS 'data_size10', 
				SUM(CASE WHEN size = '2' THEN +quantity END) AS 'data_size11', 
				SUM(CASE WHEN size = '2T' THEN +quantity END) AS 'data_size12', 
				SUM(CASE WHEN size = '3' THEN +quantity END) AS 'data_size13', 
				SUM(CASE WHEN size = '3T' THEN +quantity END) AS 'data_size14', 
				SUM(CASE WHEN size = '4' THEN +quantity END) AS 'data_size15', 
				SUM(CASE WHEN size = '4T' THEN +quantity END) AS 'data_size16', 
				SUM(CASE WHEN size = '5' THEN +quantity END) AS 'data_size17', 
				SUM(CASE WHEN size = '5T' THEN +quantity END) AS 'data_size18', 
				SUM(CASE WHEN size = '6' THEN +quantity END) AS 'data_size19', 
				SUM(CASE WHEN size = '6T' THEN +quantity END) AS 'data_size20', 
				SUM(CASE WHEN size = '7' THEN +quantity END) AS 'data_size21', 
				SUM(CASE WHEN size = '7T' THEN +quantity END) AS 'data_size22', 
				SUM(CASE WHEN size = '8' THEN +quantity END) AS 'data_size23', 
				SUM(CASE WHEN size = '8T' THEN +quantity END) AS 'data_size24', 
				SUM(CASE WHEN size = '9' THEN +quantity END) AS 'data_size25', 
				SUM(CASE WHEN size = '9T' THEN +quantity END) AS 'data_size26', 
				SUM(CASE WHEN size = '10' THEN +quantity END) AS 'data_size27', 
				SUM(CASE WHEN size = '10T' THEN +quantity END) AS 'data_size28', 
				SUM(CASE WHEN size = '11' THEN +quantity END) AS 'data_size29', 
				SUM(CASE WHEN size = '11T' THEN +quantity END) AS 'data_size30', 
				SUM(CASE WHEN size = '12' THEN +quantity END) AS 'data_size31', 
				SUM(CASE WHEN size = '12T' THEN +quantity END) AS 'data_size32', 
				SUM(CASE WHEN size = '13' THEN +quantity END) AS 'data_size33', 
				SUM(CASE WHEN size = '13T' THEN +quantity END) AS 'data_size34', 
				SUM(CASE WHEN size = '14' THEN +quantity END) AS 'data_size35', 
				SUM(CASE WHEN size = '14T' THEN +quantity END) AS 'data_size36', 
				SUM(CASE WHEN size = '15' THEN +quantity END) AS 'data_size37', 
				SUM(CASE WHEN size = '15T' THEN +quantity END) AS 'data_size38', 
				SUM(CASE WHEN size = '16' THEN +quantity END) AS 'data_size39', 
				SUM(CASE WHEN size = '16T' THEN +quantity END) AS 'data_size40', 
				SUM(CASE WHEN size = '17' THEN +quantity END) AS 'data_size41', 
				SUM(CASE WHEN size = '17T' THEN +quantity END) AS 'data_size42', 
				SUM(CASE WHEN size = '18' THEN +quantity END) AS 'data_size43', 
				SUM(CASE WHEN size = '18T' THEN +quantity END) AS 'data_size44', 
			SUM(quantity) AS TOTAL FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND description IN ('INCOME','SAMPLE') UNION ALL SELECT model, color, description, 
				SUM(CASE WHEN size = '10K' THEN +quantity END) AS 'data_size1', 
				SUM(CASE WHEN size = '10TK' THEN +quantity END) AS 'data_size2', 
				SUM(CASE WHEN size = '11K' THEN +quantity END) AS 'data_size3', 
				SUM(CASE WHEN size = '11TK' THEN +quantity END) AS 'data_size4', 
				SUM(CASE WHEN size = '12K' THEN +quantity END) AS 'data_size5', 
				SUM(CASE WHEN size = '12TK' THEN +quantity END) AS 'data_size6', 
				SUM(CASE WHEN size = '13K' THEN +quantity END) AS 'data_size7', 
				SUM(CASE WHEN size = '13TK' THEN +quantity END) AS 'data_size8', 
				SUM(CASE WHEN size = '1' THEN +quantity END) AS 'data_size9', 
				SUM(CASE WHEN size = '1T' THEN +quantity END) AS 'data_size10', 
				SUM(CASE WHEN size = '2' THEN +quantity END) AS 'data_size11', 
				SUM(CASE WHEN size = '2T' THEN +quantity END) AS 'data_size12', 
				SUM(CASE WHEN size = '3' THEN +quantity END) AS 'data_size13', 
				SUM(CASE WHEN size = '3T' THEN +quantity END) AS 'data_size14', 
				SUM(CASE WHEN size = '4' THEN +quantity END) AS 'data_size15', 
				SUM(CASE WHEN size = '4T' THEN +quantity END) AS 'data_size16', 
				SUM(CASE WHEN size = '5' THEN +quantity END) AS 'data_size17', 
				SUM(CASE WHEN size = '5T' THEN +quantity END) AS 'data_size18', 
				SUM(CASE WHEN size = '6' THEN +quantity END) AS 'data_size19', 
				SUM(CASE WHEN size = '6T' THEN +quantity END) AS 'data_size20', 
				SUM(CASE WHEN size = '7' THEN +quantity END) AS 'data_size21', 
				SUM(CASE WHEN size = '7T' THEN +quantity END) AS 'data_size22', 
				SUM(CASE WHEN size = '8' THEN +quantity END) AS 'data_size23', 
				SUM(CASE WHEN size = '8T' THEN +quantity END) AS 'data_size24', 
				SUM(CASE WHEN size = '9' THEN +quantity END) AS 'data_size25', 
				SUM(CASE WHEN size = '9T' THEN +quantity END) AS 'data_size26', 
				SUM(CASE WHEN size = '10' THEN +quantity END) AS 'data_size27', 
				SUM(CASE WHEN size = '10T' THEN +quantity END) AS 'data_size28', 
				SUM(CASE WHEN size = '11' THEN +quantity END) AS 'data_size29', 
				SUM(CASE WHEN size = '11T' THEN +quantity END) AS 'data_size30', 
				SUM(CASE WHEN size = '12' THEN +quantity END) AS 'data_size31', 
				SUM(CASE WHEN size = '12T' THEN +quantity END) AS 'data_size32', 
				SUM(CASE WHEN size = '13' THEN +quantity END) AS 'data_size33', 
				SUM(CASE WHEN size = '13T' THEN +quantity END) AS 'data_size34', 
				SUM(CASE WHEN size = '14' THEN +quantity END) AS 'data_size35', 
				SUM(CASE WHEN size = '14T' THEN +quantity END) AS 'data_size36', 
				SUM(CASE WHEN size = '15' THEN +quantity END) AS 'data_size37', 
				SUM(CASE WHEN size = '15T' THEN +quantity END) AS 'data_size38', 
				SUM(CASE WHEN size = '16' THEN +quantity END) AS 'data_size39', 
				SUM(CASE WHEN size = '16T' THEN +quantity END) AS 'data_size40', 
				SUM(CASE WHEN size = '17' THEN +quantity END) AS 'data_size41', 
				SUM(CASE WHEN size = '17T' THEN +quantity END) AS 'data_size42', 
				SUM(CASE WHEN size = '18' THEN +quantity END) AS 'data_size43', 
				SUM(CASE WHEN size = '18T' THEN +quantity END) AS 'data_size44', 
			SUM(quantity) AS TOTAL FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND description IN ('INCOME','SAMPLE') GROUP BY model, color, description ORDER BY model, color, description ASC")->result();
		}else{
			$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND original_barcode = '0' ORDER BY date_time")->result();
		}
		$file_name=date('d-m-Y')."_Summary Monthly";
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename={$file_name}.xls");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		$data['tanggal1']=$tanggal1;
		$data['tanggal2']=$tanggal2;
		$data['tipe']=$tipe;
		$data['tanggal']=$tanggal;
		$this->load->view('excel_summary_monthly',$data);
	}
	
	//print detail receiving / shipping user
	public function print_detail($tipe,$tanggal,$jam){
		$data['username']=$this->session->userdata['username'];
		if($tipe=="receiving"){
			$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM receiving ORDER BY date_time")->result();
			$file_name=date('d-m-Y')."_Detail Receiving";
			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename={$file_name}.xls");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			$data['tipe']=$tipe;
			$data['tanggal']=$tanggal;
			$data['jam']=$jam;
			$this->load->view('excel_detail',$data);
		}elseif($tipe=="shipping"){
			$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM shipping ORDER BY date_time")->result();
			$file_name=date('d-m-Y')."_Detail Shipping";
			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename={$file_name}.xls");
			header("Expires: 0");
			$data['tipe']=$tipe;
			$data['tanggal']=$tanggal;
			$data['jam']=$jam;
			$this->load->view('excel_detail',$data);
		}
	}
	
	//print summary user
	public function print_summary_user($tipe,$tanggal,$jam){
		$data['username']=$this->session->userdata['username'];
		$username=$this->session->userdata['username'];
		if($tipe=="receiving"){
			$data['detail']=$this->model_transaksi->custom_query
			("SELECT 'X' AS model, 'X' AS color, 'GRAND TOTAL' AS description, 
				SUM(CASE WHEN size = '10K' THEN +quantity END) AS 'data_size1', 
				SUM(CASE WHEN size = '10TK' THEN +quantity END) AS 'data_size2', 
				SUM(CASE WHEN size = '11K' THEN +quantity END) AS 'data_size3', 
				SUM(CASE WHEN size = '11TK' THEN +quantity END) AS 'data_size4', 
				SUM(CASE WHEN size = '12K' THEN +quantity END) AS 'data_size5', 
				SUM(CASE WHEN size = '12TK' THEN +quantity END) AS 'data_size6', 
				SUM(CASE WHEN size = '13K' THEN +quantity END) AS 'data_size7', 
				SUM(CASE WHEN size = '13TK' THEN +quantity END) AS 'data_size8', 
				SUM(CASE WHEN size = '1' THEN +quantity END) AS 'data_size9', 
				SUM(CASE WHEN size = '1T' THEN +quantity END) AS 'data_size10', 
				SUM(CASE WHEN size = '2' THEN +quantity END) AS 'data_size11', 
				SUM(CASE WHEN size = '2T' THEN +quantity END) AS 'data_size12', 
				SUM(CASE WHEN size = '3' THEN +quantity END) AS 'data_size13', 
				SUM(CASE WHEN size = '3T' THEN +quantity END) AS 'data_size14', 
				SUM(CASE WHEN size = '4' THEN +quantity END) AS 'data_size15', 
				SUM(CASE WHEN size = '4T' THEN +quantity END) AS 'data_size16', 
				SUM(CASE WHEN size = '5' THEN +quantity END) AS 'data_size17', 
				SUM(CASE WHEN size = '5T' THEN +quantity END) AS 'data_size18', 
				SUM(CASE WHEN size = '6' THEN +quantity END) AS 'data_size19', 
				SUM(CASE WHEN size = '6T' THEN +quantity END) AS 'data_size20', 
				SUM(CASE WHEN size = '7' THEN +quantity END) AS 'data_size21', 
				SUM(CASE WHEN size = '7T' THEN +quantity END) AS 'data_size22', 
				SUM(CASE WHEN size = '8' THEN +quantity END) AS 'data_size23', 
				SUM(CASE WHEN size = '8T' THEN +quantity END) AS 'data_size24', 
				SUM(CASE WHEN size = '9' THEN +quantity END) AS 'data_size25', 
				SUM(CASE WHEN size = '9T' THEN +quantity END) AS 'data_size26', 
				SUM(CASE WHEN size = '10' THEN +quantity END) AS 'data_size27', 
				SUM(CASE WHEN size = '10T' THEN +quantity END) AS 'data_size28', 
				SUM(CASE WHEN size = '11' THEN +quantity END) AS 'data_size29', 
				SUM(CASE WHEN size = '11T' THEN +quantity END) AS 'data_size30', 
				SUM(CASE WHEN size = '12' THEN +quantity END) AS 'data_size31', 
				SUM(CASE WHEN size = '12T' THEN +quantity END) AS 'data_size32', 
				SUM(CASE WHEN size = '13' THEN +quantity END) AS 'data_size33', 
				SUM(CASE WHEN size = '13T' THEN +quantity END) AS 'data_size34', 
				SUM(CASE WHEN size = '14' THEN +quantity END) AS 'data_size35', 
				SUM(CASE WHEN size = '14T' THEN +quantity END) AS 'data_size36', 
				SUM(CASE WHEN size = '15' THEN +quantity END) AS 'data_size37', 
				SUM(CASE WHEN size = '15T' THEN +quantity END) AS 'data_size38', 
				SUM(CASE WHEN size = '16' THEN +quantity END) AS 'data_size39', 
				SUM(CASE WHEN size = '16T' THEN +quantity END) AS 'data_size40', 
				SUM(CASE WHEN size = '17' THEN +quantity END) AS 'data_size41', 
				SUM(CASE WHEN size = '17T' THEN +quantity END) AS 'data_size42', 
				SUM(CASE WHEN size = '18' THEN +quantity END) AS 'data_size43', 
				SUM(CASE WHEN size = '18T' THEN +quantity END) AS 'data_size44', 
			SUM(quantity) AS TOTAL FROM receiving WHERE username = '$username' UNION ALL SELECT model, color, description, 
				SUM(CASE WHEN size = '10K' THEN +quantity END) AS 'data_size1', 
				SUM(CASE WHEN size = '10TK' THEN +quantity END) AS 'data_size2', 
				SUM(CASE WHEN size = '11K' THEN +quantity END) AS 'data_size3', 
				SUM(CASE WHEN size = '11TK' THEN +quantity END) AS 'data_size4', 
				SUM(CASE WHEN size = '12K' THEN +quantity END) AS 'data_size5', 
				SUM(CASE WHEN size = '12TK' THEN +quantity END) AS 'data_size6', 
				SUM(CASE WHEN size = '13K' THEN +quantity END) AS 'data_size7', 
				SUM(CASE WHEN size = '13TK' THEN +quantity END) AS 'data_size8', 
				SUM(CASE WHEN size = '1' THEN +quantity END) AS 'data_size9', 
				SUM(CASE WHEN size = '1T' THEN +quantity END) AS 'data_size10', 
				SUM(CASE WHEN size = '2' THEN +quantity END) AS 'data_size11', 
				SUM(CASE WHEN size = '2T' THEN +quantity END) AS 'data_size12', 
				SUM(CASE WHEN size = '3' THEN +quantity END) AS 'data_size13', 
				SUM(CASE WHEN size = '3T' THEN +quantity END) AS 'data_size14', 
				SUM(CASE WHEN size = '4' THEN +quantity END) AS 'data_size15', 
				SUM(CASE WHEN size = '4T' THEN +quantity END) AS 'data_size16', 
				SUM(CASE WHEN size = '5' THEN +quantity END) AS 'data_size17', 
				SUM(CASE WHEN size = '5T' THEN +quantity END) AS 'data_size18', 
				SUM(CASE WHEN size = '6' THEN +quantity END) AS 'data_size19', 
				SUM(CASE WHEN size = '6T' THEN +quantity END) AS 'data_size20', 
				SUM(CASE WHEN size = '7' THEN +quantity END) AS 'data_size21', 
				SUM(CASE WHEN size = '7T' THEN +quantity END) AS 'data_size22', 
				SUM(CASE WHEN size = '8' THEN +quantity END) AS 'data_size23', 
				SUM(CASE WHEN size = '8T' THEN +quantity END) AS 'data_size24', 
				SUM(CASE WHEN size = '9' THEN +quantity END) AS 'data_size25', 
				SUM(CASE WHEN size = '9T' THEN +quantity END) AS 'data_size26', 
				SUM(CASE WHEN size = '10' THEN +quantity END) AS 'data_size27', 
				SUM(CASE WHEN size = '10T' THEN +quantity END) AS 'data_size28', 
				SUM(CASE WHEN size = '11' THEN +quantity END) AS 'data_size29', 
				SUM(CASE WHEN size = '11T' THEN +quantity END) AS 'data_size30', 
				SUM(CASE WHEN size = '12' THEN +quantity END) AS 'data_size31', 
				SUM(CASE WHEN size = '12T' THEN +quantity END) AS 'data_size32', 
				SUM(CASE WHEN size = '13' THEN +quantity END) AS 'data_size33', 
				SUM(CASE WHEN size = '13T' THEN +quantity END) AS 'data_size34', 
				SUM(CASE WHEN size = '14' THEN +quantity END) AS 'data_size35', 
				SUM(CASE WHEN size = '14T' THEN +quantity END) AS 'data_size36', 
				SUM(CASE WHEN size = '15' THEN +quantity END) AS 'data_size37', 
				SUM(CASE WHEN size = '15T' THEN +quantity END) AS 'data_size38', 
				SUM(CASE WHEN size = '16' THEN +quantity END) AS 'data_size39', 
				SUM(CASE WHEN size = '16T' THEN +quantity END) AS 'data_size40', 
				SUM(CASE WHEN size = '17' THEN +quantity END) AS 'data_size41', 
				SUM(CASE WHEN size = '17T' THEN +quantity END) AS 'data_size42', 
				SUM(CASE WHEN size = '18' THEN +quantity END) AS 'data_size43', 
				SUM(CASE WHEN size = '18T' THEN +quantity END) AS 'data_size44', 
			SUM(quantity) AS TOTAL FROM receiving WHERE username = '$username' GROUP BY model, color, description ORDER BY model, color, description ASC")->result();		
		}elseif($tipe=="shipping"){
			$data['detail']=$this->model_transaksi->custom_query
			("SELECT 'X' AS model, 'X' AS color, 'GRAND TOTAL' AS description, 
				SUM(CASE WHEN size = '10K' THEN +quantity END) AS 'data_size1', 
				SUM(CASE WHEN size = '10TK' THEN +quantity END) AS 'data_size2', 
				SUM(CASE WHEN size = '11K' THEN +quantity END) AS 'data_size3', 
				SUM(CASE WHEN size = '11TK' THEN +quantity END) AS 'data_size4', 
				SUM(CASE WHEN size = '12K' THEN +quantity END) AS 'data_size5', 
				SUM(CASE WHEN size = '12TK' THEN +quantity END) AS 'data_size6', 
				SUM(CASE WHEN size = '13K' THEN +quantity END) AS 'data_size7', 
				SUM(CASE WHEN size = '13TK' THEN +quantity END) AS 'data_size8', 
				SUM(CASE WHEN size = '1' THEN +quantity END) AS 'data_size9', 
				SUM(CASE WHEN size = '1T' THEN +quantity END) AS 'data_size10', 
				SUM(CASE WHEN size = '2' THEN +quantity END) AS 'data_size11', 
				SUM(CASE WHEN size = '2T' THEN +quantity END) AS 'data_size12', 
				SUM(CASE WHEN size = '3' THEN +quantity END) AS 'data_size13', 
				SUM(CASE WHEN size = '3T' THEN +quantity END) AS 'data_size14', 
				SUM(CASE WHEN size = '4' THEN +quantity END) AS 'data_size15', 
				SUM(CASE WHEN size = '4T' THEN +quantity END) AS 'data_size16', 
				SUM(CASE WHEN size = '5' THEN +quantity END) AS 'data_size17', 
				SUM(CASE WHEN size = '5T' THEN +quantity END) AS 'data_size18', 
				SUM(CASE WHEN size = '6' THEN +quantity END) AS 'data_size19', 
				SUM(CASE WHEN size = '6T' THEN +quantity END) AS 'data_size20', 
				SUM(CASE WHEN size = '7' THEN +quantity END) AS 'data_size21', 
				SUM(CASE WHEN size = '7T' THEN +quantity END) AS 'data_size22', 
				SUM(CASE WHEN size = '8' THEN +quantity END) AS 'data_size23', 
				SUM(CASE WHEN size = '8T' THEN +quantity END) AS 'data_size24', 
				SUM(CASE WHEN size = '9' THEN +quantity END) AS 'data_size25', 
				SUM(CASE WHEN size = '9T' THEN +quantity END) AS 'data_size26', 
				SUM(CASE WHEN size = '10' THEN +quantity END) AS 'data_size27', 
				SUM(CASE WHEN size = '10T' THEN +quantity END) AS 'data_size28', 
				SUM(CASE WHEN size = '11' THEN +quantity END) AS 'data_size29', 
				SUM(CASE WHEN size = '11T' THEN +quantity END) AS 'data_size30', 
				SUM(CASE WHEN size = '12' THEN +quantity END) AS 'data_size31', 
				SUM(CASE WHEN size = '12T' THEN +quantity END) AS 'data_size32', 
				SUM(CASE WHEN size = '13' THEN +quantity END) AS 'data_size33', 
				SUM(CASE WHEN size = '13T' THEN +quantity END) AS 'data_size34', 
				SUM(CASE WHEN size = '14' THEN +quantity END) AS 'data_size35', 
				SUM(CASE WHEN size = '14T' THEN +quantity END) AS 'data_size36', 
				SUM(CASE WHEN size = '15' THEN +quantity END) AS 'data_size37', 
				SUM(CASE WHEN size = '15T' THEN +quantity END) AS 'data_size38', 
				SUM(CASE WHEN size = '16' THEN +quantity END) AS 'data_size39', 
				SUM(CASE WHEN size = '16T' THEN +quantity END) AS 'data_size40', 
				SUM(CASE WHEN size = '17' THEN +quantity END) AS 'data_size41', 
				SUM(CASE WHEN size = '17T' THEN +quantity END) AS 'data_size42', 
				SUM(CASE WHEN size = '18' THEN +quantity END) AS 'data_size43', 
				SUM(CASE WHEN size = '18T' THEN +quantity END) AS 'data_size44', 
			SUM(quantity) AS TOTAL FROM shipping WHERE username = '$username' UNION ALL SELECT model, color, description, 
				SUM(CASE WHEN size = '10K' THEN +quantity END) AS 'data_size1', 
				SUM(CASE WHEN size = '10TK' THEN +quantity END) AS 'data_size2', 
				SUM(CASE WHEN size = '11K' THEN +quantity END) AS 'data_size3', 
				SUM(CASE WHEN size = '11TK' THEN +quantity END) AS 'data_size4', 
				SUM(CASE WHEN size = '12K' THEN +quantity END) AS 'data_size5', 
				SUM(CASE WHEN size = '12TK' THEN +quantity END) AS 'data_size6', 
				SUM(CASE WHEN size = '13K' THEN +quantity END) AS 'data_size7', 
				SUM(CASE WHEN size = '13TK' THEN +quantity END) AS 'data_size8', 
				SUM(CASE WHEN size = '1' THEN +quantity END) AS 'data_size9', 
				SUM(CASE WHEN size = '1T' THEN +quantity END) AS 'data_size10', 
				SUM(CASE WHEN size = '2' THEN +quantity END) AS 'data_size11', 
				SUM(CASE WHEN size = '2T' THEN +quantity END) AS 'data_size12', 
				SUM(CASE WHEN size = '3' THEN +quantity END) AS 'data_size13', 
				SUM(CASE WHEN size = '3T' THEN +quantity END) AS 'data_size14', 
				SUM(CASE WHEN size = '4' THEN +quantity END) AS 'data_size15', 
				SUM(CASE WHEN size = '4T' THEN +quantity END) AS 'data_size16', 
				SUM(CASE WHEN size = '5' THEN +quantity END) AS 'data_size17', 
				SUM(CASE WHEN size = '5T' THEN +quantity END) AS 'data_size18', 
				SUM(CASE WHEN size = '6' THEN +quantity END) AS 'data_size19', 
				SUM(CASE WHEN size = '6T' THEN +quantity END) AS 'data_size20', 
				SUM(CASE WHEN size = '7' THEN +quantity END) AS 'data_size21', 
				SUM(CASE WHEN size = '7T' THEN +quantity END) AS 'data_size22', 
				SUM(CASE WHEN size = '8' THEN +quantity END) AS 'data_size23', 
				SUM(CASE WHEN size = '8T' THEN +quantity END) AS 'data_size24', 
				SUM(CASE WHEN size = '9' THEN +quantity END) AS 'data_size25', 
				SUM(CASE WHEN size = '9T' THEN +quantity END) AS 'data_size26', 
				SUM(CASE WHEN size = '10' THEN +quantity END) AS 'data_size27', 
				SUM(CASE WHEN size = '10T' THEN +quantity END) AS 'data_size28', 
				SUM(CASE WHEN size = '11' THEN +quantity END) AS 'data_size29', 
				SUM(CASE WHEN size = '11T' THEN +quantity END) AS 'data_size30', 
				SUM(CASE WHEN size = '12' THEN +quantity END) AS 'data_size31', 
				SUM(CASE WHEN size = '12T' THEN +quantity END) AS 'data_size32', 
				SUM(CASE WHEN size = '13' THEN +quantity END) AS 'data_size33', 
				SUM(CASE WHEN size = '13T' THEN +quantity END) AS 'data_size34', 
				SUM(CASE WHEN size = '14' THEN +quantity END) AS 'data_size35', 
				SUM(CASE WHEN size = '14T' THEN +quantity END) AS 'data_size36', 
				SUM(CASE WHEN size = '15' THEN +quantity END) AS 'data_size37', 
				SUM(CASE WHEN size = '15T' THEN +quantity END) AS 'data_size38', 
				SUM(CASE WHEN size = '16' THEN +quantity END) AS 'data_size39', 
				SUM(CASE WHEN size = '16T' THEN +quantity END) AS 'data_size40', 
				SUM(CASE WHEN size = '17' THEN +quantity END) AS 'data_size41', 
				SUM(CASE WHEN size = '17T' THEN +quantity END) AS 'data_size42', 
				SUM(CASE WHEN size = '18' THEN +quantity END) AS 'data_size43', 
				SUM(CASE WHEN size = '18T' THEN +quantity END) AS 'data_size44', 
			SUM(quantity) AS TOTAL FROM shipping WHERE username = '$username' GROUP BY model, color, description ORDER BY model, color, description ASC")->result();
		}else{
			$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND original_barcode = '0' ORDER BY date_time")->result();
		}
		$file_name=date('d-m-Y')."_Summary Daily";
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename={$file_name}.xls");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		$data['tipe']=$tipe;
		$data['tanggal']=$tanggal;
		$data['jam']=$jam;
		$data['username']=$username;
		$this->load->view('excel_summary',$data);
	}
	
	//print summary IT
	public function print_summary_it($tipe,$tanggal,$jam){
		$data['username']=$this->session->userdata['username'];
		$username=$this->session->userdata['username'];
		if($tipe=="receiving"){
			$data['detail']=$this->model_transaksi->custom_query
			("SELECT 'X' AS model, 'X' AS color, 'GRAND TOTAL' AS description, 
				SUM(CASE WHEN size = '10K' THEN +quantity END) AS 'data_size1', 
				SUM(CASE WHEN size = '10TK' THEN +quantity END) AS 'data_size2', 
				SUM(CASE WHEN size = '11K' THEN +quantity END) AS 'data_size3', 
				SUM(CASE WHEN size = '11TK' THEN +quantity END) AS 'data_size4', 
				SUM(CASE WHEN size = '12K' THEN +quantity END) AS 'data_size5', 
				SUM(CASE WHEN size = '12TK' THEN +quantity END) AS 'data_size6', 
				SUM(CASE WHEN size = '13K' THEN +quantity END) AS 'data_size7', 
				SUM(CASE WHEN size = '13TK' THEN +quantity END) AS 'data_size8', 
				SUM(CASE WHEN size = '1' THEN +quantity END) AS 'data_size9', 
				SUM(CASE WHEN size = '1T' THEN +quantity END) AS 'data_size10', 
				SUM(CASE WHEN size = '2' THEN +quantity END) AS 'data_size11', 
				SUM(CASE WHEN size = '2T' THEN +quantity END) AS 'data_size12', 
				SUM(CASE WHEN size = '3' THEN +quantity END) AS 'data_size13', 
				SUM(CASE WHEN size = '3T' THEN +quantity END) AS 'data_size14', 
				SUM(CASE WHEN size = '4' THEN +quantity END) AS 'data_size15', 
				SUM(CASE WHEN size = '4T' THEN +quantity END) AS 'data_size16', 
				SUM(CASE WHEN size = '5' THEN +quantity END) AS 'data_size17', 
				SUM(CASE WHEN size = '5T' THEN +quantity END) AS 'data_size18', 
				SUM(CASE WHEN size = '6' THEN +quantity END) AS 'data_size19', 
				SUM(CASE WHEN size = '6T' THEN +quantity END) AS 'data_size20', 
				SUM(CASE WHEN size = '7' THEN +quantity END) AS 'data_size21', 
				SUM(CASE WHEN size = '7T' THEN +quantity END) AS 'data_size22', 
				SUM(CASE WHEN size = '8' THEN +quantity END) AS 'data_size23', 
				SUM(CASE WHEN size = '8T' THEN +quantity END) AS 'data_size24', 
				SUM(CASE WHEN size = '9' THEN +quantity END) AS 'data_size25', 
				SUM(CASE WHEN size = '9T' THEN +quantity END) AS 'data_size26', 
				SUM(CASE WHEN size = '10' THEN +quantity END) AS 'data_size27', 
				SUM(CASE WHEN size = '10T' THEN +quantity END) AS 'data_size28', 
				SUM(CASE WHEN size = '11' THEN +quantity END) AS 'data_size29', 
				SUM(CASE WHEN size = '11T' THEN +quantity END) AS 'data_size30', 
				SUM(CASE WHEN size = '12' THEN +quantity END) AS 'data_size31', 
				SUM(CASE WHEN size = '12T' THEN +quantity END) AS 'data_size32', 
				SUM(CASE WHEN size = '13' THEN +quantity END) AS 'data_size33', 
				SUM(CASE WHEN size = '13T' THEN +quantity END) AS 'data_size34', 
				SUM(CASE WHEN size = '14' THEN +quantity END) AS 'data_size35', 
				SUM(CASE WHEN size = '14T' THEN +quantity END) AS 'data_size36', 
				SUM(CASE WHEN size = '15' THEN +quantity END) AS 'data_size37', 
				SUM(CASE WHEN size = '15T' THEN +quantity END) AS 'data_size38', 
				SUM(CASE WHEN size = '16' THEN +quantity END) AS 'data_size39', 
				SUM(CASE WHEN size = '16T' THEN +quantity END) AS 'data_size40', 
				SUM(CASE WHEN size = '17' THEN +quantity END) AS 'data_size41', 
				SUM(CASE WHEN size = '17T' THEN +quantity END) AS 'data_size42', 
				SUM(CASE WHEN size = '18' THEN +quantity END) AS 'data_size43', 
				SUM(CASE WHEN size = '18T' THEN +quantity END) AS 'data_size44', 
			SUM(quantity) AS TOTAL FROM receiving UNION ALL SELECT model, color, description, 
				SUM(CASE WHEN size = '10K' THEN +quantity END) AS 'data_size1', 
				SUM(CASE WHEN size = '10TK' THEN +quantity END) AS 'data_size2', 
				SUM(CASE WHEN size = '11K' THEN +quantity END) AS 'data_size3', 
				SUM(CASE WHEN size = '11TK' THEN +quantity END) AS 'data_size4', 
				SUM(CASE WHEN size = '12K' THEN +quantity END) AS 'data_size5', 
				SUM(CASE WHEN size = '12TK' THEN +quantity END) AS 'data_size6', 
				SUM(CASE WHEN size = '13K' THEN +quantity END) AS 'data_size7', 
				SUM(CASE WHEN size = '13TK' THEN +quantity END) AS 'data_size8', 
				SUM(CASE WHEN size = '1' THEN +quantity END) AS 'data_size9', 
				SUM(CASE WHEN size = '1T' THEN +quantity END) AS 'data_size10', 
				SUM(CASE WHEN size = '2' THEN +quantity END) AS 'data_size11', 
				SUM(CASE WHEN size = '2T' THEN +quantity END) AS 'data_size12', 
				SUM(CASE WHEN size = '3' THEN +quantity END) AS 'data_size13', 
				SUM(CASE WHEN size = '3T' THEN +quantity END) AS 'data_size14', 
				SUM(CASE WHEN size = '4' THEN +quantity END) AS 'data_size15', 
				SUM(CASE WHEN size = '4T' THEN +quantity END) AS 'data_size16', 
				SUM(CASE WHEN size = '5' THEN +quantity END) AS 'data_size17', 
				SUM(CASE WHEN size = '5T' THEN +quantity END) AS 'data_size18', 
				SUM(CASE WHEN size = '6' THEN +quantity END) AS 'data_size19', 
				SUM(CASE WHEN size = '6T' THEN +quantity END) AS 'data_size20', 
				SUM(CASE WHEN size = '7' THEN +quantity END) AS 'data_size21', 
				SUM(CASE WHEN size = '7T' THEN +quantity END) AS 'data_size22', 
				SUM(CASE WHEN size = '8' THEN +quantity END) AS 'data_size23', 
				SUM(CASE WHEN size = '8T' THEN +quantity END) AS 'data_size24', 
				SUM(CASE WHEN size = '9' THEN +quantity END) AS 'data_size25', 
				SUM(CASE WHEN size = '9T' THEN +quantity END) AS 'data_size26', 
				SUM(CASE WHEN size = '10' THEN +quantity END) AS 'data_size27', 
				SUM(CASE WHEN size = '10T' THEN +quantity END) AS 'data_size28', 
				SUM(CASE WHEN size = '11' THEN +quantity END) AS 'data_size29', 
				SUM(CASE WHEN size = '11T' THEN +quantity END) AS 'data_size30', 
				SUM(CASE WHEN size = '12' THEN +quantity END) AS 'data_size31', 
				SUM(CASE WHEN size = '12T' THEN +quantity END) AS 'data_size32', 
				SUM(CASE WHEN size = '13' THEN +quantity END) AS 'data_size33', 
				SUM(CASE WHEN size = '13T' THEN +quantity END) AS 'data_size34', 
				SUM(CASE WHEN size = '14' THEN +quantity END) AS 'data_size35', 
				SUM(CASE WHEN size = '14T' THEN +quantity END) AS 'data_size36', 
				SUM(CASE WHEN size = '15' THEN +quantity END) AS 'data_size37', 
				SUM(CASE WHEN size = '15T' THEN +quantity END) AS 'data_size38', 
				SUM(CASE WHEN size = '16' THEN +quantity END) AS 'data_size39', 
				SUM(CASE WHEN size = '16T' THEN +quantity END) AS 'data_size40', 
				SUM(CASE WHEN size = '17' THEN +quantity END) AS 'data_size41', 
				SUM(CASE WHEN size = '17T' THEN +quantity END) AS 'data_size42', 
				SUM(CASE WHEN size = '18' THEN +quantity END) AS 'data_size43', 
				SUM(CASE WHEN size = '18T' THEN +quantity END) AS 'data_size44', 
			SUM(quantity) AS TOTAL FROM receiving GROUP BY model, color, description ORDER BY model, color, description ASC")->result();		
		}elseif($tipe=="shipping"){
			$data['detail']=$this->model_transaksi->custom_query
			("SELECT 'X' AS model, 'X' AS color, 'GRAND TOTAL' AS description, 
				SUM(CASE WHEN size = '10K' THEN +quantity END) AS 'data_size1', 
				SUM(CASE WHEN size = '10TK' THEN +quantity END) AS 'data_size2', 
				SUM(CASE WHEN size = '11K' THEN +quantity END) AS 'data_size3', 
				SUM(CASE WHEN size = '11TK' THEN +quantity END) AS 'data_size4', 
				SUM(CASE WHEN size = '12K' THEN +quantity END) AS 'data_size5', 
				SUM(CASE WHEN size = '12TK' THEN +quantity END) AS 'data_size6', 
				SUM(CASE WHEN size = '13K' THEN +quantity END) AS 'data_size7', 
				SUM(CASE WHEN size = '13TK' THEN +quantity END) AS 'data_size8', 
				SUM(CASE WHEN size = '1' THEN +quantity END) AS 'data_size9', 
				SUM(CASE WHEN size = '1T' THEN +quantity END) AS 'data_size10', 
				SUM(CASE WHEN size = '2' THEN +quantity END) AS 'data_size11', 
				SUM(CASE WHEN size = '2T' THEN +quantity END) AS 'data_size12', 
				SUM(CASE WHEN size = '3' THEN +quantity END) AS 'data_size13', 
				SUM(CASE WHEN size = '3T' THEN +quantity END) AS 'data_size14', 
				SUM(CASE WHEN size = '4' THEN +quantity END) AS 'data_size15', 
				SUM(CASE WHEN size = '4T' THEN +quantity END) AS 'data_size16', 
				SUM(CASE WHEN size = '5' THEN +quantity END) AS 'data_size17', 
				SUM(CASE WHEN size = '5T' THEN +quantity END) AS 'data_size18', 
				SUM(CASE WHEN size = '6' THEN +quantity END) AS 'data_size19', 
				SUM(CASE WHEN size = '6T' THEN +quantity END) AS 'data_size20', 
				SUM(CASE WHEN size = '7' THEN +quantity END) AS 'data_size21', 
				SUM(CASE WHEN size = '7T' THEN +quantity END) AS 'data_size22', 
				SUM(CASE WHEN size = '8' THEN +quantity END) AS 'data_size23', 
				SUM(CASE WHEN size = '8T' THEN +quantity END) AS 'data_size24', 
				SUM(CASE WHEN size = '9' THEN +quantity END) AS 'data_size25', 
				SUM(CASE WHEN size = '9T' THEN +quantity END) AS 'data_size26', 
				SUM(CASE WHEN size = '10' THEN +quantity END) AS 'data_size27', 
				SUM(CASE WHEN size = '10T' THEN +quantity END) AS 'data_size28', 
				SUM(CASE WHEN size = '11' THEN +quantity END) AS 'data_size29', 
				SUM(CASE WHEN size = '11T' THEN +quantity END) AS 'data_size30', 
				SUM(CASE WHEN size = '12' THEN +quantity END) AS 'data_size31', 
				SUM(CASE WHEN size = '12T' THEN +quantity END) AS 'data_size32', 
				SUM(CASE WHEN size = '13' THEN +quantity END) AS 'data_size33', 
				SUM(CASE WHEN size = '13T' THEN +quantity END) AS 'data_size34', 
				SUM(CASE WHEN size = '14' THEN +quantity END) AS 'data_size35', 
				SUM(CASE WHEN size = '14T' THEN +quantity END) AS 'data_size36', 
				SUM(CASE WHEN size = '15' THEN +quantity END) AS 'data_size37', 
				SUM(CASE WHEN size = '15T' THEN +quantity END) AS 'data_size38', 
				SUM(CASE WHEN size = '16' THEN +quantity END) AS 'data_size39', 
				SUM(CASE WHEN size = '16T' THEN +quantity END) AS 'data_size40', 
				SUM(CASE WHEN size = '17' THEN +quantity END) AS 'data_size41', 
				SUM(CASE WHEN size = '17T' THEN +quantity END) AS 'data_size42', 
				SUM(CASE WHEN size = '18' THEN +quantity END) AS 'data_size43', 
				SUM(CASE WHEN size = '18T' THEN +quantity END) AS 'data_size44', 
			SUM(quantity) AS TOTAL FROM shipping UNION ALL SELECT model, color, description, 
				SUM(CASE WHEN size = '10K' THEN +quantity END) AS 'data_size1', 
				SUM(CASE WHEN size = '10TK' THEN +quantity END) AS 'data_size2', 
				SUM(CASE WHEN size = '11K' THEN +quantity END) AS 'data_size3', 
				SUM(CASE WHEN size = '11TK' THEN +quantity END) AS 'data_size4', 
				SUM(CASE WHEN size = '12K' THEN +quantity END) AS 'data_size5', 
				SUM(CASE WHEN size = '12TK' THEN +quantity END) AS 'data_size6', 
				SUM(CASE WHEN size = '13K' THEN +quantity END) AS 'data_size7', 
				SUM(CASE WHEN size = '13TK' THEN +quantity END) AS 'data_size8', 
				SUM(CASE WHEN size = '1' THEN +quantity END) AS 'data_size9', 
				SUM(CASE WHEN size = '1T' THEN +quantity END) AS 'data_size10', 
				SUM(CASE WHEN size = '2' THEN +quantity END) AS 'data_size11', 
				SUM(CASE WHEN size = '2T' THEN +quantity END) AS 'data_size12', 
				SUM(CASE WHEN size = '3' THEN +quantity END) AS 'data_size13', 
				SUM(CASE WHEN size = '3T' THEN +quantity END) AS 'data_size14', 
				SUM(CASE WHEN size = '4' THEN +quantity END) AS 'data_size15', 
				SUM(CASE WHEN size = '4T' THEN +quantity END) AS 'data_size16', 
				SUM(CASE WHEN size = '5' THEN +quantity END) AS 'data_size17', 
				SUM(CASE WHEN size = '5T' THEN +quantity END) AS 'data_size18', 
				SUM(CASE WHEN size = '6' THEN +quantity END) AS 'data_size19', 
				SUM(CASE WHEN size = '6T' THEN +quantity END) AS 'data_size20', 
				SUM(CASE WHEN size = '7' THEN +quantity END) AS 'data_size21', 
				SUM(CASE WHEN size = '7T' THEN +quantity END) AS 'data_size22', 
				SUM(CASE WHEN size = '8' THEN +quantity END) AS 'data_size23', 
				SUM(CASE WHEN size = '8T' THEN +quantity END) AS 'data_size24', 
				SUM(CASE WHEN size = '9' THEN +quantity END) AS 'data_size25', 
				SUM(CASE WHEN size = '9T' THEN +quantity END) AS 'data_size26', 
				SUM(CASE WHEN size = '10' THEN +quantity END) AS 'data_size27', 
				SUM(CASE WHEN size = '10T' THEN +quantity END) AS 'data_size28', 
				SUM(CASE WHEN size = '11' THEN +quantity END) AS 'data_size29', 
				SUM(CASE WHEN size = '11T' THEN +quantity END) AS 'data_size30', 
				SUM(CASE WHEN size = '12' THEN +quantity END) AS 'data_size31', 
				SUM(CASE WHEN size = '12T' THEN +quantity END) AS 'data_size32', 
				SUM(CASE WHEN size = '13' THEN +quantity END) AS 'data_size33', 
				SUM(CASE WHEN size = '13T' THEN +quantity END) AS 'data_size34', 
				SUM(CASE WHEN size = '14' THEN +quantity END) AS 'data_size35', 
				SUM(CASE WHEN size = '14T' THEN +quantity END) AS 'data_size36', 
				SUM(CASE WHEN size = '15' THEN +quantity END) AS 'data_size37', 
				SUM(CASE WHEN size = '15T' THEN +quantity END) AS 'data_size38', 
				SUM(CASE WHEN size = '16' THEN +quantity END) AS 'data_size39', 
				SUM(CASE WHEN size = '16T' THEN +quantity END) AS 'data_size40', 
				SUM(CASE WHEN size = '17' THEN +quantity END) AS 'data_size41', 
				SUM(CASE WHEN size = '17T' THEN +quantity END) AS 'data_size42', 
				SUM(CASE WHEN size = '18' THEN +quantity END) AS 'data_size43', 
				SUM(CASE WHEN size = '18T' THEN +quantity END) AS 'data_size44', 
			SUM(quantity) AS TOTAL FROM shipping GROUP BY model, color, description ORDER BY model, color, description ASC")->result();
		}else{
			$data['detail']=$this->model_transaksi->custom_query("SELECT * FROM data_shipping WHERE date_time BETWEEN '$tanggal1 07:30:00' AND '$tanggal2 07:29:59' AND original_barcode = '0' ORDER BY date_time")->result();
		}
		$file_name=date('d-m-Y')."_Summary Daily";
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename={$file_name}.xls");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		$data['tipe']=$tipe;
		$data['tanggal']=$tanggal;
		$data['jam']=$jam;
		$data['username']=$username;
		$this->load->view('excel_summary',$data);
	}
	
	//print transaction
	public function print_transaction(){
		$data['username']=$this->session->userdata['username'];
		$data['detail_stok']=$this->model_transaksi->custom_query("SELECT no, stock_awal, receiving, shipping, stock_akhir, date FROM stok ORDER BY date ASC")->result();
		$file_name=date('d-m-Y');
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename={$file_name}.xls");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		$this->load->view('excel_transaction',$data);
	}
	
	//function Move Data Receiving
	public function mover(){
		$date=date('Y-m-d 07:30:00');
		$this->model_monitoring->insertr($date);
		$this->model_monitoring->deleter($date);
		redirect('controller_scan/receiving_it');
	}
	
	//function Move Data Shipping
	public function moves(){
		$date=date('Y-m-d 07:30:00');
		$this->model_monitoring->inserts($date);
		$this->model_monitoring->deletes($date);
		redirect('controller_scan/shipping_it');
	}
	
	//function Record Rec & Shi
	public function record(){
		$conv_tipe=$_POST['tipe'];
		$tipe="data_".$conv_tipe;
		$y1=substr($_POST['tanggal'],6,4);
		$m1=substr($_POST['tanggal'],0,2);
		$d1=substr($_POST['tanggal'],3,2);
		$date1="'".$y1."-".$m1."-".$d1." 07:30:00'";
		$y2=substr($_POST['tanggal'],-4,4);
		$m2=substr($_POST['tanggal'],-10,2);
		$d2=substr($_POST['tanggal'],-7,2);
		$date2="'".$y2."-".$m2."-".$d2. " 07:29:59'";
		$sess_array = array('tipe' => $tipe, 
							'date1' => $date1, 
							'date2' => $date2);
		$this->session->set_userdata('datatable', $sess_array);
		$data['username']=$this->session->userdata['username'];
		$data['usernames']=$this->model_scan->get_username()->result();
		$data['tipe']=$conv_tipe;
		$this->template->load('template_it','view_record',$data);
	}
	
	//function Backup Rec & Shi
	public function backup(){
		$conv_backup=$_POST['tipe'];
		$backup="backup_".$conv_backup;
		$conv_data=$_POST['tipe'];
		$tipe="data_".$conv_data;
		$data1=date('Y');
		$data2="-01-01 07:30:00";
		$date=$data1.$data2;
		$this->model_monitoring->insert($backup,$tipe,$date);
		$this->model_monitoring->delete($tipe,$date);
		$data['username']=$this->session->userdata['username'];
		$this->template->load('template_it','view_master_data',$data);
	}
	
	//function Duplicate Rec & Shi
	public function duplicate(){
		$conv_tipe=$_POST['tipe'];
		$tipe="data_".$conv_tipe;
		$y1=substr($_POST['tanggal'],6,4);
		$m1=substr($_POST['tanggal'],0,2);
		$d1=substr($_POST['tanggal'],3,2);
		$tanggal1=$y1."-".$m1."-".$d1;
		$y2=substr($_POST['tanggal'],-4,4);
		$m2=substr($_POST['tanggal'],-10,2);
		$d2=substr($_POST['tanggal'],-7,2);
		$tanggal2=$y2."-".$m2."-".$d2;
		$this->model_monitoring->insert_duplicate($tipe,$tanggal1,$tanggal2);
		$this->model_monitoring->delete_duplicate($tipe,$tanggal1,$tanggal2);
		$this->model_monitoring->insert_record($tipe,$tanggal1,$tanggal2);
		$this->model_monitoring->delete_record($tipe,$tanggal1,$tanggal2);
		$data['username']=$this->session->userdata['username'];
		$this->template->load('template_it','view_master_data',$data);
	}
	
	//function Reset Stock
	public function resets(){
		$this->model_monitoring->resets();
		$this->session->set_flashdata
		('msg','<div class="alert bg-red alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
			<center>Data Stock Berhasil Direset</center>
			</div>');
		redirect('controller_monitoring/stock_opname');
	}
	
	public function dashboard_it(){
		$data['username']=$this->session->userdata['username'];

		$tanggal=date('Y-m-d H:i:s');
		
		$date1=date('Y-m-d 23:59:59');
		$date2=date('Y-m-d 00:00:00');

		$date_now=date('Y-m-d');
		$date_yesterday=date('Y-m-d',strtotime("-1 day"));
		
		$yesterday=$date_yesterday.' 07:30:00';

		$start=date('Y-m-d 07:30:00');

		if($tanggal<=$date1 && $tanggal>=$start){
			$start_date=date('Y-m-d 07:30:00');
			$end_date=date('Y-m-d 07:29:59',strtotime("+1 day"));

			$start_date_before=date('Y-m-d 07:30:00',strtotime("-1 day"));
			$end_date_before=date('Y-m-d 07:29:59');

			$max_date=$this->model_transaksi->custom_query("SELECT MAX(date) AS date FROM stok WHERE CONVERT(VARCHAR, date, 23) <> '$date_now'")->row()->date;
			$cek_data=$this->model_transaksi->custom_query("SELECT * FROM stok WHERE CONVERT(VARCHAR, date, 23) <> '$date_now'");
		}
		elseif($tanggal>=$date2 && $tanggal<=$start){
			$start_date=date('Y-m-d 07:30:00',strtotime("-1 day"));
			$end_date=date('Y-m-d 07:29:59');

			$start_date_before=date('Y-m-d 07:30:00',strtotime("-2 day"));
			$end_date_before=date('Y-m-d 07:29:59',strtotime("-1 day"));

			$max_date=$this->model_transaksi->custom_query("SELECT MAX(date) AS date FROM stok WHERE CONVERT(VARCHAR, date, 23) <> '$date_now' AND CONVERT(VARCHAR, date, 23) <> '$date_yesterday'")->row()->date;
			$cek_data=$this->model_transaksi->custom_query("SELECT * FROM stok WHERE CONVERT(VARCHAR, date, 23) <> '$date_now' AND CONVERT(VARCHAR, date, 23) <> '$date_yesterday'");
		}

		$now=date('Y-m-d');

		$rec=$this->model_transaksi->custom_query("SELECT SUM(quantity) AS rec FROM receiving WHERE CONVERT(VARCHAR, date_time, 20) BETWEEN '$start_date' AND '$end_date'")->row()->rec;
			if($rec == NULL){
				$rec = "0";
			}else{
				$rec;
			};
		$shi=$this->model_transaksi->custom_query("SELECT SUM(quantity) AS shi FROM shipping WHERE CONVERT(VARCHAR, date_time, 20) BETWEEN '$start_date' AND '$end_date'")->row()->shi;
			if($shi == NULL){
				$shi = "0";
			}else{
				$shi;
			};
		$sta=$this->model_transaksi->custom_query("SELECT SUM(stock) AS total FROM master_database")->row()->total;
			if($sta == NULL){
				$sta = "0";
			}else{
				$sta;
			};
		$stk=$sta+($rec-$shi); 
		
		$data1=array(
			'stock_awal'	=> $sta,
			'receiving'		=> $rec,
			'shipping'		=> $shi,
			'stock_akhir'	=> $stk
		);

		if($tanggal<=$date1 && $tanggal>=$start){
			$update_stock=$this->model_transaksi->update("stok", $data1, "CONVERT(VARCHAR, date, 20) BETWEEN '$start_date' AND '$end_date'");
		}else{
			$update_stock=$this->model_transaksi->update("stok", $data1, "CONVERT(VARCHAR, date, 20) BETWEEN '$start_date' AND '$end_date'");
		}

		$data['receiving']=$rec;
		$data['shipping']=$shi;
		$data['stock_awal']=$sta;	
		$data['stock_akhir']=$stk;			
		$data['result_receiving']=$this->model_transaksi->custom_query("SELECT TOP 5 * FROM receiving ORDER BY date_time DESC");
		$data['result_shipping']=$this->model_transaksi->custom_query("SELECT TOP 5 * FROM shipping ORDER BY date_time DESC");
		$data['detail_daily']=$this->model_monitoring->get_data_daily();
		$data['detail_shift']=$this->model_monitoring->get_chart_shift($yesterday)->result();
		$data['detail_warehouse']=$this->model_monitoring->get_chart_warehouse()->result();
		$data['kemarin']=$date_yesterday;
		$this->template->load('template_it','view_dashboard',$data);
	}

	public function dashboard_server(){
		$data['username']=$this->session->userdata['username'];

		$tanggal=date('Y-m-d H:i:s');
		
		$date1=date('Y-m-d 23:59:59');
		$date2=date('Y-m-d 00:00:00');

		$date_now=date('Y-m-d');
		$date_yesterday=date('Y-m-d',strtotime("-1 day"));
		
		$yesterday=$date_yesterday.' 07:30:00';

		$start=date('Y-m-d 07:30:00');

		if($tanggal<=$date1 && $tanggal>=$start){
			$start_date=date('Y-m-d 07:30:00');
			$end_date=date('Y-m-d 07:29:59',strtotime("+1 day"));

			$start_date_before=date('Y-m-d 07:30:00',strtotime("-1 day"));
			$end_date_before=date('Y-m-d 07:29:59');

			$max_date=$this->model_transaksi->custom_query("SELECT MAX(date) AS date FROM stok WHERE CONVERT(VARCHAR, date, 23) <> '$date_now'")->row()->date;
			$cek_data=$this->model_transaksi->custom_query("SELECT * FROM stok WHERE CONVERT(VARCHAR, date, 23) <> '$date_now'");
		}
		elseif($tanggal>=$date2 && $tanggal<=$start){
			$start_date=date('Y-m-d 07:30:00',strtotime("-1 day"));
			$end_date=date('Y-m-d 07:29:59');

			$start_date_before=date('Y-m-d 07:30:00',strtotime("-2 day"));
			$end_date_before=date('Y-m-d 07:29:59',strtotime("-1 day"));

			$max_date=$this->model_transaksi->custom_query("SELECT MAX(date) AS date FROM stok WHERE CONVERT(VARCHAR, date, 23) <> '$date_now' AND CONVERT(VARCHAR, date, 23) <> '$date_yesterday'")->row()->date;
			$cek_data=$this->model_transaksi->custom_query("SELECT * FROM stok WHERE CONVERT(VARCHAR, date, 23) <> '$date_now' AND CONVERT(VARCHAR, date, 23) <> '$date_yesterday'");
		}

		$now=date('Y-m-d');

		$rec=$this->model_transaksi->custom_query("SELECT SUM(quantity) AS rec FROM receiving WHERE CONVERT(VARCHAR, date_time, 20) BETWEEN '$start_date' AND '$end_date'")->row()->rec;
			if($rec == NULL){
				$rec = "0";
			}else{
				$rec;
			};
		$shi=$this->model_transaksi->custom_query("SELECT SUM(quantity) AS shi FROM shipping WHERE CONVERT(VARCHAR, date_time, 20) BETWEEN '$start_date' AND '$end_date'")->row()->shi;
			if($shi == NULL){
				$shi = "0";
			}else{
				$shi;
			};
		$sta=$this->model_transaksi->custom_query("SELECT SUM(stock) AS total FROM master_database")->row()->total;
			if($sta == NULL){
				$sta = "0";
			}else{
				$sta;
			};
		$stk=$sta+($rec-$shi); 
		
		$data1=array(
			'stock_awal'	=> $sta,
			'receiving'		=> $rec,
			'shipping'		=> $shi,
			'stock_akhir'	=> $stk
		);

		if($tanggal<=$date1 && $tanggal>=$start){
			$update_stock=$this->model_transaksi->update("stok", $data1, "CONVERT(VARCHAR, date, 20) BETWEEN '$start_date' AND '$end_date'");
		}else{
			$update_stock=$this->model_transaksi->update("stok", $data1, "CONVERT(VARCHAR, date, 20) BETWEEN '$start_date' AND '$end_date'");
		}
		
		$date=date('Y-m-d 07:30:00');
		$time=date('H:i:s');
		$trans=date('07:30:00');
		$trans2=date('07:30:06');
		//catatan: setiap pukul 07:30:00 - 07:30:06 proses perpindahan data 
		if($time>=$trans && $time<=$trans2){
			$this->model_transaksi->custom_query("INSERT INTO data_receiving SELECT * FROM receiving WHERE date_time < '$date'");
			$this->model_transaksi->custom_query("INSERT INTO data_shipping SELECT * FROM shipping WHERE date_time < '$date'");
			$this->model_transaksi->custom_query("DELETE FROM receiving WHERE date_time < '$date'");
			$this->model_transaksi->custom_query("DELETE FROM shipping WHERE date_time < '$date'");
		}else{
			$this->model_transaksi->custom_query("INSERT INTO data_receiving SELECT * FROM receiving WHERE model='0'");	
		}

		$data['receiving']=$rec;
		$data['shipping']=$shi;
		$data['stock_awal']=$sta;	
		$data['stock_akhir']=$stk;			
		$data['result_receiving']=$this->model_transaksi->custom_query("SELECT TOP 5 * FROM receiving ORDER BY date_time DESC");
		$data['result_shipping']=$this->model_transaksi->custom_query("SELECT TOP 5 * FROM shipping ORDER BY date_time DESC");
		$data['detail_daily']=$this->model_monitoring->get_data_daily();
		$data['detail_shift']=$this->model_monitoring->get_chart_shift($yesterday)->result();
		$data['detail_warehouse']=$this->model_monitoring->get_chart_warehouse()->result();
		$data['kemarin']=$date_yesterday;
		$this->template->load('template_server','view_dashboard',$data);
	}

	public function dashboard_management(){
		$data['username']=$this->session->userdata['username'];

		$tanggal=date('Y-m-d H:i:s');
		
		$date1=date('Y-m-d 23:59:59');
		$date2=date('Y-m-d 00:00:00');

		$date_now=date('Y-m-d');
		$date_yesterday=date('Y-m-d',strtotime("-1 day"));
		
		$yesterday=$date_yesterday.' 07:30:00';

		$start=date('Y-m-d 07:30:00');

		if($tanggal<=$date1 && $tanggal>=$start){
			$start_date=date('Y-m-d 07:30:00');
			$end_date=date('Y-m-d 07:29:59',strtotime("+1 day"));

			$start_date_before=date('Y-m-d 07:30:00',strtotime("-1 day"));
			$end_date_before=date('Y-m-d 07:29:59');

			$max_date=$this->model_transaksi->custom_query("SELECT MAX(date) AS date FROM stok WHERE CONVERT(VARCHAR, date, 23) <> '$date_now'")->row()->date;
			$cek_data=$this->model_transaksi->custom_query("SELECT * FROM stok WHERE CONVERT(VARCHAR, date, 23) <> '$date_now'");
		}
		elseif($tanggal>=$date2 && $tanggal<=$start){
			$start_date=date('Y-m-d 07:30:00',strtotime("-1 day"));
			$end_date=date('Y-m-d 07:29:59');

			$start_date_before=date('Y-m-d 07:30:00',strtotime("-2 day"));
			$end_date_before=date('Y-m-d 07:29:59',strtotime("-1 day"));

			$max_date=$this->model_transaksi->custom_query("SELECT MAX(date) AS date FROM stok WHERE CONVERT(VARCHAR, date, 23) <> '$date_now' AND CONVERT(VARCHAR, date, 23) <> '$date_yesterday'")->row()->date;
			$cek_data=$this->model_transaksi->custom_query("SELECT * FROM stok WHERE CONVERT(VARCHAR, date, 23) <> '$date_now' AND CONVERT(VARCHAR, date, 23) <> '$date_yesterday'");
		}

		$now=date('Y-m-d');

		$rec=$this->model_transaksi->custom_query("SELECT SUM(quantity) AS rec FROM receiving WHERE CONVERT(VARCHAR, date_time, 20) BETWEEN '$start_date' AND '$end_date'")->row()->rec;
			if($rec == NULL){
				$rec = "0";
			}else{
				$rec;
			};
		$shi=$this->model_transaksi->custom_query("SELECT SUM(quantity) AS shi FROM shipping WHERE CONVERT(VARCHAR, date_time, 20) BETWEEN '$start_date' AND '$end_date'")->row()->shi;
			if($shi == NULL){
				$shi = "0";
			}else{
				$shi;
			};
		$sta=$this->model_transaksi->custom_query("SELECT SUM(stock) AS total FROM master_database")->row()->total;
			if($sta == NULL){
				$sta = "0";
			}else{
				$sta;
			};
		$stk=$sta+($rec-$shi); 
		
		$data1=array(
			'stock_awal'	=> $sta,
			'receiving'		=> $rec,
			'shipping'		=> $shi,
			'stock_akhir'	=> $stk
		);

		if($tanggal<=$date1 && $tanggal>=$start){
			$update_stock=$this->model_transaksi->update("stok", $data1, "CONVERT(VARCHAR, date, 20) BETWEEN '$start_date' AND '$end_date'");
		}else{
			$update_stock=$this->model_transaksi->update("stok", $data1, "CONVERT(VARCHAR, date, 20) BETWEEN '$start_date' AND '$end_date'");
		}

		$data['receiving']=$rec;
		$data['shipping']=$shi;
		$data['stock_awal']=$sta;	
		$data['stock_akhir']=$stk;			
		$data['result_receiving']=$this->model_transaksi->custom_query("SELECT TOP 5 * FROM receiving ORDER BY date_time DESC");
		$data['result_shipping']=$this->model_transaksi->custom_query("SELECT TOP 5 * FROM shipping ORDER BY date_time DESC");
		$data['detail_daily']=$this->model_monitoring->get_data_daily();
		$data['detail_shift']=$this->model_monitoring->get_chart_shift($yesterday)->result();
		$data['detail_warehouse']=$this->model_monitoring->get_chart_warehouse()->result();
		$data['kemarin']=$date_yesterday;
		$this->template->load('template_management','view_dashboard',$data);
	}
	
	public function stock_opname(){
		$data['username']=$this->session->userdata['username'];
		$this->template->load('template_it','view_stock_opname',$data);	
	}

	public function add_barcode(){
		$data['username']=$this->session->userdata['username'];
		$this->template->load('template_it','view_add_barcode',$data);	
	}

	public function import_add_barcode(){
		if($_SERVER['REQUEST_METHOD']=='POST'){
			$upload_status=$this->uploadbarcode();
			if($upload_status!=false){
				$inputFileName='assets/uploads/barcode/'.$upload_status;
				$inputTileType=\PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
				$reader=\PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputTileType);
				$spreadsheet=$reader->load($inputFileName);
				$sheet=$spreadsheet->getSheet(0);
				$username=$this->session->userdata['username'];
				date_default_timezone_set("Asia/Bangkok");
				$waktu=date('Y-m-d H:i:s');
				$stock="0";
				$data=[];
				$numrow=1;
				
				foreach($sheet->getRowIterator() as $row){
					$barcode=$spreadsheet->getActiveSheet()->getCell('A'.$row->getRowIndex());
					$cek=$this->model_monitoring->cek_barcode($barcode);
					$masuk=0;
					if($cek == false) { //jika tidak ada yang sama
						if($numrow > 1){
						// push (add) array data ke variabel data
							array_push($data, [
								'original_barcode'	=> $spreadsheet->getActiveSheet()->getCell('A'.$row->getRowIndex()),
								'brand'				=> $spreadsheet->getActiveSheet()->getCell('B'.$row->getRowIndex()),
								'color'				=> $spreadsheet->getActiveSheet()->getCell('C'.$row->getRowIndex()),
								'size'				=> $spreadsheet->getActiveSheet()->getCell('D'.$row->getRowIndex()),
								'four_digit'		=> $spreadsheet->getActiveSheet()->getCell('E'.$row->getRowIndex()),
								'unit'				=> $spreadsheet->getActiveSheet()->getCell('F'.$row->getRowIndex()),
								'quantity'			=> $spreadsheet->getActiveSheet()->getCell('G'.$row->getRowIndex()),
								'production'		=> $spreadsheet->getActiveSheet()->getCell('H'.$row->getRowIndex()),
								'model'				=> $spreadsheet->getActiveSheet()->getCell('I'.$row->getRowIndex()),
								'model_code'		=> $spreadsheet->getActiveSheet()->getCell('J'.$row->getRowIndex()),
								'item'				=> $spreadsheet->getActiveSheet()->getCell('K'.$row->getRowIndex()),
								'username'			=> $username,
								'date_time'			=> $waktu,
								'stock'				=> $stock,
							]);
						}
					$masuk++;
				}
				$numrow++; // tambah 1 setiap kali looping
				}
						
				if($masuk > 0){
					$this->model_monitoring->insert_multiple($data);
					$this->session->set_flashdata
					('msg','<div class="alert bg-green alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
					<center>Data Berhasil Diinputkan</center>
					</div>');
					redirect("controller_monitoring/master");
				}else{
					$this->session->set_flashdata
					('msg','<div class="alert bg-red alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
					<center>Data Gagal Diinputkan</center>
					</div>'); 
					redirect("controller_monitoring/master");
				}
			}else{
				$this->session->set_flashdata
				('msg','<div class="alert bg-red alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
				<center>Data Gagal Diinputkan</center>
				</div>'); 
				redirect("controller_monitoring/master");
			}
		}else{
			redirect("controller_monitoring/master");
		}
	}
	
	public function import_stock_opname(){
		if($_SERVER['REQUEST_METHOD']=='POST'){
			$upload_status=$this->uploadstock();
			if($upload_status!=false){
				$inputFileName='assets/uploads/stock/'.$upload_status;
				$inputTileType=\PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
				$reader=\PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputTileType);
				$spreadsheet=$reader->load($inputFileName);
				$sheet=$spreadsheet->getSheet(0);
				$data=[];
				$numrow=1;
				
				foreach($sheet->getRowIterator() as $row){
					if($numrow > 1){
						// push (add) array data ke variabel data
							array_push($data, [
								'original_barcode'	=> $spreadsheet->getActiveSheet()->getCell('A'.$row->getRowIndex()),
								'stock'				=> $spreadsheet->getActiveSheet()->getCell('N'.$row->getRowIndex()),
							]);
						}
					$numrow++; // tambah 1 setiap kali looping
				}
				$this->model_monitoring->update_multiple($data);
				redirect("controller_monitoring/master");
			}else{
				redirect("controller_monitoring/master");
			}
		}else{
			redirect("controller_monitoring/master");
		}
	}

	function uploadbarcode(){
		$uploadPath='assets/uploads/barcode/';
		if(!is_dir($uploadPath)){
			mkdir($uploadPath,0777,TRUE); // FOR CREATING DIRECTORY IF ITS NOT EXIST
		}

		$config['upload_path']=$uploadPath;
		$config['allowed_types']='csv|xlsx|xls';
		$config['max_size']=1000000;
		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		if($this->upload->do_upload('upload_excel')){
			$fileData=$this->upload->data();
			return $fileData['file_name'];
		}else{
			return false;
		}
	}
	
	function uploadstock(){
		$uploadPath='assets/uploads/stock/';
		if(!is_dir($uploadPath)){
			mkdir($uploadPath,0777,TRUE); // FOR CREATING DIRECTORY IF ITS NOT EXIST
		}

		$config['upload_path']=$uploadPath;
		$config['allowed_types']='csv|xlsx|xls';
		$config['max_size']=1000000;
		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		if($this->upload->do_upload('upload_excel')){
			$fileData=$this->upload->data();
			return $fileData['file_name'];
		}else{
			return false;
		}
	}
}