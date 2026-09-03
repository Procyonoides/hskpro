<?php
class model_scan extends ci_model{
	public function getoriginalbarcode($id){
		$this->db->where('original_barcode', $id);
		$this->db->select('original_barcode');
		return $this->db->get('master_database')->row()->original_barcode;
	}
	
	public function getbarcodereceiving($id){
		$this->db->where('original_barcode', $id);
		$this->db->select('original_barcode');
		return $this->db->get('master_database')->row()->original_barcode;
	}
	
	public function getbarcodeshipping($id){
		$this->db->where('original_barcode', $id);
		$this->db->select('barcode_shipping');
		return $this->db->get('master_database')->row()->barcode_shipping;
	}
	
	public function getbrand($id){
		$this->db->where('original_barcode', $id);
		$this->db->select('brand');
		return $this->db->get('master_database')->row()->brand;
	}
	
	public function getcolor($id){
		$this->db->where('original_barcode', $id);
		$this->db->select('color');
		return $this->db->get('master_database')->row()->color;
	}
	
	public function getsize($id){
		$this->db->where('original_barcode', $id);
		$this->db->select('size');
		return $this->db->get('master_database')->row()->size;
	}
	
	public function getfourdigit($id){
		$this->db->where('original_barcode', $id);
		$this->db->select('four_digit');
		return $this->db->get('master_database')->row()->four_digit;
	}
	
	public function getunit($id){
		$this->db->where('original_barcode', $id);
		$this->db->select('unit');
		return $this->db->get('master_database')->row()->unit;
	}
	
	public function getquantity($id){
		$this->db->where('original_barcode', $id);
		$this->db->select('quantity');
		return $this->db->get('master_database')->row()->quantity;
	}
	
	public function getproduction($id){
		$this->db->where('original_barcode', $id);
		$this->db->select('production');
		return $this->db->get('master_database')->row()->production;
	}
	
	public function getmodel($id){
		$this->db->where('original_barcode', $id);
		$this->db->select('model');
		return $this->db->get('master_database')->row()->model;
	}
	
	public function getmodelcode($id){
		$this->db->where('original_barcode', $id);
		$this->db->select('model_code');
		return $this->db->get('master_database')->row()->model_code;
	}
	
	public function getitem($id){
		$this->db->where('original_barcode', $id);
		$this->db->select('item');
		return $this->db->get('master_database')->row()->item;
	}
	
	public function getdescription($user){
		$this->db->where('username', $user);
		$this->db->select('description');
		return $this->db->get('users')->row()->description;
	}
	
	public function Generatereceiving($original_barcode,$brand,$color,$size,$four_digit,$unit,$quantity,$production,$model,$model_code,$item,$username,$description){
		$waktu=date('Y-m-d');
		$this->db->where("CONVERT(VARCHAR, date_time, 23) LIKE ", $waktu, "%");
		$this->db->select_max('scan_no');
		$scan_no=$this->db->get('receiving')->row()->scan_no;
		$scan_no=$scan_no + 1;
		date_default_timezone_set("Asia/Bangkok");
		$date=date('Y-m-d H:i:s');
		$input=array(
			'original_barcode' 	=> $original_barcode,
			'brand' 			=> $brand,
			'color' 			=> $color,
			'size' 				=> $size,
			'four_digit' 		=> $four_digit,
			'unit' 				=> $unit,
			'quantity' 			=> $quantity,
			'production' 		=> $production,
			'model' 			=> $model,
			'model_code' 		=> $model_code,
			'item' 				=> $item,
			'date_time' 		=> $date,
			'scan_no' 			=> $scan_no,
			'username' 			=> $username,
			'description' 		=> $description,
		);
		$this->db->insert('receiving', $input);
	}
	
	function role_exists($key){
		$this->db->where('rolekey',$key);
		$query=$this->db->get('roles');
		if ($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function Generateshipping($original_barcode,$brand,$color,$size,$four_digit,$unit,$quantity,$production,$model,$model_code,$item,$username,$description){
		$waktu=date('Y-m-d');
		$this->db->where("CONVERT(VARCHAR, date_time, 23) LIKE ", $waktu, "%");			
		$this->db->select_max('scan_no');
		$scan_no=$this->db->get('shipping')->row()->scan_no;
		$scan_no=$scan_no + 1;
		date_default_timezone_set("Asia/Bangkok");
		$date=date('Y-m-d H:i:s');
		$input=array(
			'original_barcode' 	=> $original_barcode,
			'brand' 			=> $brand,
			'color' 			=> $color,
			'size' 				=> $size,
			'four_digit' 		=> $four_digit,
			'unit' 				=> $unit,
			'quantity' 			=> $quantity,
			'production' 		=> $production,
			'model' 			=> $model,
			'model_code' 		=> $model_code,
			'item' 				=> $item,
			'date_time' 		=> $date,
			'scan_no' 			=> $scan_no,
			'username' 			=> $username,
			'description' 		=> $description,
		);
		$this->db->insert('shipping', $input);		
	}
	
	//data receiving
	public function fetchdatar($user){
		$this->db->select('original_barcode,brand,color,size,four_digit,unit,quantity,production,model,model_code,item,date_time,scan_no,username');
		$this->db->from('receiving');
		$this->db->where('username', $user);
		$this->db->order_by('date_time','DESC');
		$this->db->limit('10');
		$query=$this->db->get();
		return $query->result();
	}
	
	//data shipping
	public function fetchdatas($user){
		$this->db->select('original_barcode,brand,color,size,four_digit,unit,quantity,production,model,model_code,item,date_time,scan_no,username');
		$this->db->from('shipping');
		$this->db->where('username', $user);
		$this->db->order_by('date_time','DESC');
		$this->db->limit('10');
		$query=$this->db->get();
		return $query->result();
	}
	
	public function custom_query($query){
		$sql=$this->db->query($query);
		return $sql;
	}
	
	//create datatable receiving
	function get_all_rec(){
		$this->datatables->select('original_barcode,brand,color,size,four_digit,unit,quantity,production,model,model_code,item,date_time,scan_no,username,description');
		$this->datatables->from('receiving');
		$this->datatables->add_column('view', '<a href="javascript:void(0);" class="edit_record btn btn-info btn-sm" data-date="$1" data-scan="$2" data-user="$3"> <i class="fa fa-pencil"> Edit</i> </a> <a href="javascript:void(0);" class="delete_record btn btn-danger btn-sm" data-date="$1" data-scan="$2" data-user="$3"> <i class="fa fa-trash-o"> Delete</i> </a>','date_time,scan_no,username');
		return $this->datatables->generate();
	}
	
	//create datatable shipping
	function get_all_shi(){
		$this->datatables->select('original_barcode,brand,color,size,four_digit,unit,quantity,production,model,model_code,item,date_time,scan_no,username,description');
		$this->datatables->from('shipping');
		$this->datatables->add_column('view', '<a href="javascript:void(0);" class="edit_record btn btn-info btn-sm" data-date="$1" data-scan="$2" data-user="$3"> <i class="fa fa-pencil"> Edit</i> </a> <a href="javascript:void(0);" class="delete_record btn btn-danger btn-sm" data-date="$1" data-scan="$2" data-user="$3"> <i class="fa fa-trash-o"> Delete</i> </a>','date_time,scan_no,username');
		return $this->datatables->generate();
	}
	
	//get original barcode receiving
	function get_data_rec($date,$scan,$user){
		$hsl=$this->db->query("SELECT * FROM receiving WHERE date_time = '$date' AND scan_no = '$scan' AND username = '$user'");
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
	
	//get original barcode shipping
	function get_data_shi($date,$scan,$user){
		$hsl=$this->db->query("SELECT * FROM shipping WHERE date_time = '$date' AND scan_no = '$scan' AND username = '$user'");
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
	
	//get all username
	function get_username(){
		$query=$this->db->query("SELECT * FROM users ORDER BY id_user ASC"); 
		return $query;	
	}
	
	//get description
	function get_data_by_username($username){
		$hsl=$this->db->query("SELECT * FROM users WHERE username = '$username'");
		if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
					'username'		=> $data->username,
					'position'		=> $data->position,
					'description' 	=> $data->description
				);
			}
		}
		return $hasil;
	}
}