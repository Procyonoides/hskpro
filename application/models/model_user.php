<?php
class model_user extends ci_model{
	//array untuk menyimpan label dari masing-masing atribut
	public $labels=[];
	
	public function __construct(){
		parent::__construct();
		$this->labels=$this->_attributelabels();
		$this->load->database();	
	}
	
	//create datatable
	function get_all_user(){
		$this->datatables->select('id_user,username,position,description,password');
		$this->datatables->from('users');
		$this->datatables->add_column('view', '<a href="javascript:void(0);" class="edit_record btn btn-info btn-sm" data-id="$1"> <i class="fa fa-pencil"> Edit</i> </a> </a> <a href="javascript:void(0);" class="delete_record btn btn-danger btn-sm" data-id="$1"> <i class="fa fa-trash-o"> Delete</i> </a>','id_user');
		return $this->datatables->generate();
	}
	
	//get id
	function get_data_by_id($id){
		$hsl=$this->db->query("SELECT * FROM users WHERE id_user = '$id'");
		if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
					'id_user' 		=> $data->id_user,
					'username' 		=> $data->username,
					'position' 		=> $data->position,
					'description' 	=> $data->description,
					'password' 		=> $data->password
				);
			}
		}
		return $hasil;
	}
		
	//metode untuk menentukan label dari masing-masing atribut 
	public function _attributelabels(){
		return [
			'id_user'		=> 'ID User',
			'username'		=> 'User Name',
			'position'		=> 'Posisi',
			'description'	=> 'Description',
			'password'		=> 'Password',
		];	
	}
	
	function get_position(){
		$query=$this->db->get('list_position');
		return $query;	
	}

	function get_description($description_id){
		$query=$this->db->get_where('list_description', array('position_id' => $description_id));
		return $query;
	}
}