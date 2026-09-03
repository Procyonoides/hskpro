<?php
class controller_user extends ci_controller{	
	public $model = NULL;
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model('model_user');
		$this->load->model('model_transaksi');
		$this->model=$this->model_user;
		$this->load->library('datatables');
	}
	
	public function index(){
		$this->read();
	}
	
	//get all data user by JSON object
	function get_guest_json_user() {
		header('Content-Type: application/json');
		echo $this->model_user->get_all_user();
	}
	
	//get data user by id
	function get_user(){
		$id=$_GET['id_user'];
		$data=$this->model_user->get_data_by_id($id);
		echo json_encode($data);
	}
	
	//function save user
	function save_user(){
		$username=$_POST['username'];
		$post=$_POST['position'];
		if($post=="1"){ 
			$position="SERVER";
		}else if($post=="2"){ 
			$position="IT";
		}else if($post=="3"){ 
			$position="MANAGEMENT";
		}else if($post=="4"){ 
			$position="RECEIVING";
		}else if($post=="5"){ 
			$position="SHIPPING";
		}
		$this->db->where('username',$username);
		$query=$this->db->get('users');
		if ($query->num_rows()==0) 
		{
			$data=array(
				'username'		=> $_POST['username'],
				'position'		=> $position,
				'description'	=> $_POST['description'],
				'password'		=> $_POST['password']
			);
			$this->db->insert('users',$data);
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
		$data['position']=$this->model_user->get_position()->result();
		$this->template->load('template_it', 'view_user', $data);
	}
	
	//function edit user
	function edit_user(){
		$id=$_POST['id_user_edit'];
		$post=$_POST['position_edit'];
		if($post=="1"){ 
			$position="SERVER";
		}else if($post=="2"){ 
			$position="IT";
		}else if($post=="3"){ 
			$position="MANAGEMENT";
		}else if($post=="4"){ 
			$position="RECEIVING";
		}else if($post=="5"){ 
			$position="SHIPPING";
		}
		$data=array(
			'username'		=> $_POST['username_edit'],
			'position'		=> $position,
			'description'	=> $_POST['description_edit'],
			'password'		=> $_POST['password_edit']
		);
		$this->db->where('id_user',$id);
		$this->db->update('users',$data);
		$this->session->set_flashdata
		('msg','<div class="alert bg-aqua alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
			<center>Data Berhasil Diperbarui</center>
			</div>');
		$data['username']=$this->session->userdata['username'];
		$data['position']=$this->model_user->get_position()->result();
		$this->template->load('template_it', 'view_user', $data);
	}
	
	//function delete barcode
	function delete_user(){
		$id=$_POST['id'];
		$this->db->where('id_user',$id);
		$this->db->delete('users');
		$this->session->set_flashdata
		('msg','<div class="alert bg-red alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
			<center>Data Berhasil Dihapus</center>
			</div>');
		$data['username']=$this->session->userdata['username'];
		$data['position']=$this->model_user->get_position()->result();
		$this->template->load('template_it','view_user',$data);
	}
	
	function user(){
		$data['username']=$this->session->userdata['username'];
		$data['position']=$this->model_user->get_position()->result();
		$this->template->load('template_it','view_user',$data);
	}

	function get_description(){
		$description_id=$this->input->post('id',TRUE);
		$data=$this->model_user->get_description($description_id)->result();
		echo json_encode($data);
	}
}