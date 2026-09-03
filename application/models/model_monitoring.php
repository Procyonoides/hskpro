<?php
class model_monitoring extends ci_model{
	public $original_barcode;
	public $barcode_receiving;
	public $barcode_shipping;
	public $brand;
	public $color;
	public $size;
	public $four_digit;
	public $unit;
	public $quantity;
	public $production;
	public $model;
	public $model_code;
	public $item;
	public $date_time;
	public $stock;
	public $no;
	
	//array untuk menyimpan label dari masing-masing atribut
	public $labels=[];
	
	public function __construct(){
		parent::__construct();
		$this->labels=$this->_attributelabels();
		$this->load->database();	
	}
	
	public function insertr($date){
		$sql=sprintf("INSERT INTO data_receiving SELECT * FROM receiving WHERE date_time < '$date'");
		$this->db->query($sql);
	}
	
	public function inserts($date){
		$sql=sprintf("INSERT INTO data_shipping SELECT * FROM shipping WHERE date_time < '$date'");
		$this->db->query($sql);
	}
	
	public function insert($backup,$tipe,$date){
		$sql=sprintf("INSERT INTO $backup SELECT * FROM $tipe WHERE date_time < '$date'");
		$this->db->query($sql);
	}
	
	public function deleter($date){
		$sql=sprintf("DELETE FROM receiving WHERE date_time < '$date'");
		$this->db->query($sql);
	}
	
	public function deletes($date){
		$sql=sprintf("DELETE FROM shipping WHERE date_time < '$date'");
		$this->db->query($sql);
	}
	
	public function delete($tipe,$date){
		$sql=sprintf("DELETE FROM $tipe WHERE date_time < '$date'");
		$this->db->query($sql);
	}
	
	public function insert_duplicate($tipe,$tanggal1,$tanggal2){
		$sql=sprintf("INSERT INTO duplicate SELECT DISTINCT * FROM $tipe WHERE date_time BETWEEN '$tanggal1 07:00:00' AND '$tanggal2 06:59:59'");
		$this->db->query($sql);
	}
	
	public function delete_duplicate($tipe,$tanggal1,$tanggal2){
		$sql=sprintf("DELETE FROM $tipe WHERE date_time BETWEEN '$tanggal1 07:00:00' AND '$tanggal2 06:59:59'");
		$this->db->query($sql);
	}
	
	public function insert_record($tipe,$tanggal1,$tanggal2){
		$sql=sprintf("INSERT INTO $tipe SELECT * FROM duplicate WHERE date_time BETWEEN '$tanggal1 07:00:00' AND '$tanggal2 06:59:59'");
		$this->db->query($sql);
	}
	
	public function delete_record($tipe,$tanggal1,$tanggal2){
		$sql=sprintf("DELETE FROM duplicate WHERE date_time BETWEEN '$tanggal1 07:00:00' AND '$tanggal2 06:59:59'");
		$this->db->query($sql);
	}
	
	public function resets(){
		$sql=sprintf("UPDATE master_database SET stock = '0'");
		$this->db->query($sql);
	}
	
	//metode untuk menentukan label dari masing-masing atribut 	
	public function getcolor(){
		$this->db->select('color');
		$this->db->from('master_database');
		$this->db->group_by('color');
		$this->db->order_by('color', 'ASC');
		$query=$this->db->get();
		return $query->result_array();
	}
	
	public function getsize(){
		$this->db->select('size');
		$this->db->from('master_database');
		$this->db->group_by('size');
		$this->db->order_by('size', 'ASC');
		$query=$this->db->get();
		return $query->result_array();
	}
	
	public function getmodel(){
		$this->db->select('model,model_code');
		$this->db->from('master_database');
		$this->db->group_by('model');
		$this->db->group_by('model_code');
		$this->db->order_by('model', 'ASC');
		$query=$this->db->get();
		return $query->result_array();
	}
	
	public function getuser(){
		$this->db->select('id_user,position,username,password');
		$this->db->from('users');
		$query=$this->db->get();
		return $query->result_array();
	}
	
	public function _attributelabels(){
		return [
			'original_barcode'	=> 'Original Barcode',
			'barcode_receiving'	=> 'Barcode Receiving',
			'barcode_shipping'	=> 'Barcode Shipping',
			'brand'				=> 'Brand',
			'color'				=> 'Color',
			'size'				=> 'Size',
			'four_digit'		=> 'Four Digit',
			'unit'				=> 'Unit',
			'quantity'			=> 'Quantity',
			'production'		=> 'Production',
			'model'				=> 'Model',
			'model_code'		=> 'Model Code',
			'item'				=> 'Item',
			'stock'				=> 'Stock',
			'date_time'			=> 'Date Time',
			'scan_no'			=> 'Scan No',
			'username'			=> 'Username',
			'no'				=> 'No',
			'date'				=> 'Tanggal',
			'stock_awal'		=> 'Stok Awal',
			'receiving'			=> 'Receiving',
			'shipping' 			=> 'Shipping',
			'stock_akhir'		=> 'Stok Akhir'
		];
	}
	
	//get data for chartjs
	function get_data_daily(){
		$query=$this->db->query("SELECT TOP 7 CONVERT(VARCHAR, date, 23) AS Tanggal, receiving AS Receiving, shipping AS Shipping FROM stok ORDER BY date DESC"); 
		if($query->num_rows() > 0){
			foreach($query->result() as $data){
				$hasil[]=$data;
			}
			return $hasil;
		}
	}
	
	//create datatable barcode
	function get_all_barcode(){
		$this->datatables->select('original_barcode,brand,color,size,four_digit,unit,quantity,production,model,model_code,item,username,date_time,stock');
		$this->datatables->from('master_database');
		$this->datatables->add_column('view', '<a href="javascript:void(0);" class="edit_record btn btn-info btn-sm" data-barcode="$1"> <i class="fa fa-pencil"> Edit</i> </a> <a href="javascript:void(0);" class="delete_record btn btn-danger btn-sm" data-barcode="$1"> <i class="fa fa-trash-o"> Delete</i> </a>','original_barcode');
		return $this->datatables->generate();
	}
	
	//create datatable transaksi
	function get_all_trans(){
		$this->datatables->select('no,stock_awal,receiving,shipping,stock_akhir,date');
		$this->datatables->from('stok');
		$this->datatables->add_column('view', '<a href="javascript:void(0);" class="edit_record btn btn-info btn-sm" data-no="$1"> <i class="fa fa-pencil"> Edit</i> </a> <a href="javascript:void(0);" class="delete_record btn btn-danger btn-sm" data-no="$1"> <i class="fa fa-trash-o"> Delete</i> </a>','no');
		return $this->datatables->generate();
	}
	
	//create datatable record
	function get_all_record($tipe,$date1,$date2){
		$this->datatables->select('original_barcode,brand,color,size,four_digit,unit,quantity,production,model,model_code,item,date_time,scan_no,username,description');
		$this->datatables->from('"'.$tipe.'"');
		$this->datatables->where('date_time BETWEEN '.$date1.' AND '.$date2.'');
		$this->datatables->add_column('view', '<a href="javascript:void(0);" class="edit_record btn btn-info btn-sm" data-date="$1" data-scan="$2" data-user="$3"> <i class="fa fa-pencil"> Edit</i> </a> <a href="javascript:void(0);" class="delete_record btn btn-danger btn-sm" data-date="$1" data-scan="$2" data-user="$3"> <i class="fa fa-trash-o"> Delete</i> </a>','date_time,scan_no,username');
		return $this->datatables->generate();
	}
	
	//create datatable model
	function get_all_model(){
		$this->datatables->select('model_code,model');
		$this->datatables->from('list_model');
		$this->datatables->add_column('view', '<a href="javascript:void(0);" class="edit_record btn btn-info btn-sm" data-model_code="$1"> <i class="fa fa-pencil"> Edit</i> </a> <a href="javascript:void(0);" class="delete_record btn btn-danger btn-sm" data-model_code="$1"> <i class="fa fa-trash-o"> Delete</i> </a>','model_code');
		return $this->datatables->generate();
	}
	
	//create datatable size
	function get_all_size(){
		$this->datatables->select('size_code,size');
		$this->datatables->from('list_size');
		$this->datatables->add_column('view', '<a href="javascript:void(0);" class="edit_record btn btn-info btn-sm" data-size_code="$1"> <i class="fa fa-pencil"> Edit</i> </a> <a href="javascript:void(0);" class="delete_record btn btn-danger btn-sm" data-size_code="$1"> <i class="fa fa-trash-o"> Delete</i> </a>','size_code');
		return $this->datatables->generate();
	}
	
	//create datatable production
	function get_all_production(){
		$this->datatables->select('production_code,production');
		$this->datatables->from('list_production');
		$this->datatables->add_column('view', '<a href="javascript:void(0);" class="edit_record btn btn-info btn-sm" data-production_code="$1"> <i class="fa fa-pencil"> Edit</i> </a> <a href="javascript:void(0);" class="delete_record btn btn-danger btn-sm" data-production_code="$1"> <i class="fa fa-trash-o"> Delete</i> </a>','production_code');
		return $this->datatables->generate();
	}
	
	//get data on menu stock
	function get_stock(){
		$query=$this->db->query("SELECT model, color, size, brand, item, production,
			CASE
			WHEN model IN (SELECT model FROM data_receiving WHERE date_time >= (SELECT CONVERT(VARCHAR, CONVERT(DATETIME, DATEADD(MONTH, -1, CONVERT(DATE, GETDATE()))), 23))) THEN 'RUN'
			ELSE 'STOP' END AS status_production,
			REPLACE(CAST(SUM(stock) * 100.0 / ISNULL(NULLIF((SELECT SUM(stock) FROM master_database), 0), 1) AS DECIMAL(10, 3)), '.', ',') AS 'percent',
			SUM(stock) AS total FROM master_database WHERE stock > '0' GROUP BY model, color, size, brand, item, production"); 
		return $query;	
	}
	
	//get data chart by shift 
	function get_chart_shift($yesterday){
		$query=$this->db->query("SELECT username,
			CAST(SUM(quantity) * 100.0 / (SELECT SUM(quantity) FROM data_receiving WHERE date_time > '".$yesterday."' AND description = 'INCOME' AND production = 'PT HSK REMBANG') AS DECIMAL(10, 0)) AS 'status',
			REPLACE(CAST(SUM(quantity) * 100.0 / (SELECT SUM(quantity) FROM data_receiving WHERE date_time > '".$yesterday."' AND description = 'INCOME' AND production = 'PT HSK REMBANG') AS DECIMAL(10, 2)), '.', ',') AS 'percent',
			SUM(quantity) AS 'total'
			FROM data_receiving
			WHERE date_time > '".$yesterday."' AND description = 'INCOME' AND production = 'PT HSK REMBANG'
			GROUP BY username ORDER BY username"); 
		return $query;	
	}
	
	//get data chart warehouse
	function get_chart_warehouse(){
		$query=$this->db->query("SELECT item, 
			CAST(SUM(stock) * 100.0 / ISNULL(NULLIF((SELECT SUM(stock) FROM master_database), 0), 1) AS DECIMAL(10, 0)) AS 'status', 
			SUM(stock) AS total FROM master_database 
			GROUP BY item ORDER BY total DESC");
		return $query;	
	}
	
	//get original barcode
	function get_data_by_barcode($barcode){
		$hsl=$this->db->query("SELECT * FROM master_database WHERE original_barcode = '$barcode'");
		if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
					'original_barcode' 	=> $data->original_barcode,
					'brand' 			=> $data->brand,
					'color' 			=> $data->color,
					'size' 				=> $data->size,
					'four_digit' 		=> $data->four_digit,
					'unit' 				=> $data->unit,
					'quantity' 			=> $data->quantity,
					'production' 		=> $data->production,
					'model' 			=> $data->model,
					'model_code' 		=> $data->model_code,
					'item' 				=> $data->item,
					'username' 			=> $data->username,
					'date_time' 		=> $data->date_time,
					'stock' 			=> $data->stock
				);
			}
		}
		return $hasil;
	}
	
	//get transaction
	function get_data_by_no($no){
		$hsl=$this->db->query("SELECT * FROM stok WHERE no = '$no'");
		if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
					'no' 			=> $data->no,
					'stock_awal' 	=> $data->stock_awal,
					'receiving' 	=> $data->receiving,
					'shipping' 		=> $data->shipping,
					'stock_akhir' 	=> $data->stock_akhir,
					'date' 			=> $data->date
				);
			}
		}
		return $hasil;
	}
	
	//get record
	function get_data_record($tipe,$date,$scan,$user){
		$hsl=$this->db->query("SELECT * FROM $tipe WHERE date_time = '$date' AND scan_no = '$scan' AND username = '$user'");
		if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
					'original_barcode' 	=> $data->original_barcode,
					'brand' 			=> $data->brand,
					'color' 			=> $data->color,
					'size' 				=> $data->size,
					'four_digit' 		=> $data->four_digit,
					'unit' 				=> $data->unit,
					'quantity' 			=> $data->quantity,
					'production' 		=> $data->production,
					'model' 			=> $data->model,
					'model_code' 		=> $data->model_code,
					'item' 				=> $data->item,
					'date_time' 		=> $data->date_time,
					'scan_no' 			=> $data->scan_no,
					'username' 			=> $data->username,
					'description' 		=> $data->description
				);
			}
		}
		return $hasil;
	}
	
	//get model
	function get_data_by_model_code($model_code){
		$hsl=$this->db->query("SELECT * FROM list_model WHERE model_code = '$model_code'");
		if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
					'model_code'		=> $data->model_code,
					'model' 			=> $data->model
				);
			}
		}
		return $hasil;
	}
	
	//get size
	function get_data_by_size_code($size_code){
		$hsl=$this->db->query("SELECT * FROM list_size WHERE size_code = '$size_code'");
		if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
					'size_code'			=> $data->size_code,
					'size' 				=> $data->size
				);
			}
		}
		return $hasil;
	}
	
	//get production
	function get_data_by_production_code($production_code){
		$hsl=$this->db->query("SELECT * FROM list_production WHERE production_code = '$production_code'");
		if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
					'production_code'	=> $data->production_code,
					'production' 		=> $data->production
				);
			}
		}
		return $hasil;
	}
	
	//get all model
	function get_model(){
		$query=$this->db->query("SELECT * FROM list_model ORDER BY model ASC"); 
		return $query;	
	}
	
	//get all size
	function get_size(){
		$query=$this->db->query("SELECT * FROM list_size ORDER BY size ASC"); 
		return $query;	
	}
	
	//get all production
	function get_production(){
		$query=$this->db->query("SELECT * FROM list_production ORDER BY production ASC"); 
		return $query;	
	}
	
	//get model code
	function get_model_code($model){
		$hsl=$this->db->query("SELECT * FROM list_model WHERE model = '$model'");
		if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
					'model_code'	=> $data->model_code,
					'model' 		=> $data->model
				);
			}
		}
		return $hasil;
	}
	
	//get size code
	function get_size_code($size){
		$hsl=$this->db->query("SELECT * FROM list_size WHERE size = '$size'");
		if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
					'size_code'		=> $data->size_code,
					'size' 			=> $data->size
				);
			}
		}
		return $hasil;
	}
	
	function get_master_database(){
		$query=$this->db->query("SELECT * FROM master_database"); 
		return $query;	
	}

	public function update_multiple($data){
		$this->db->update_batch('master_database', $data, 'original_barcode');
	}

	public function insert_multiple($data){
		$this->db->insert_batch('master_database', $data);
	}

	public function total(){
		$this->db->select_sum('stock','jumlah');
		$this->db->from('master_database');
		return $this->db->get('')->row();
	}

	public function cek_barcode($barcode){
		$this->db->where('original_barcode', $barcode);
		$count=$this->db->get('master_database')->num_rows();
		if($count > 0){
			return true;
		}else{
			return false;
		}
	}
}