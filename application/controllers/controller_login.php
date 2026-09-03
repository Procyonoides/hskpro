<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class controller_login extends ci_controller{	
	function cek_login(){
		$username=$_POST['username'];
		$password=$_POST['password'];
		if(isset($_POST['username'],$_POST['password'])){
			$username=$_POST['username'];
			$password=$_POST['password'];
			$query=$this->model_login->cek_username_pass($username,$password);
			if($query->num_rows() != 0){
				foreach($query->result_array() as $data){
					$sess_data['username']=$data['username'];
					$sess_data['password']=$data['password'];
					$sess_data['position']=$data['position'];
					$this->session->set_userdata($sess_data);
					$_SESSION["last_login_time"]=time();
				}
				$position=$this->session->userdata('position');
				if($position == "SERVER"){
					redirect('controller_monitoring/dashboard_server');
				}elseif($position == "IT"){
					redirect('controller_monitoring/dashboard_it');
				}elseif($position == "MANAGEMENT"){
					redirect('controller_monitoring/dashboard_management');
				}elseif($position == "RECEIVING"){
					redirect('controller_scan/receiving');
				}elseif($position == "SHIPPING"){
					redirect('controller_scan/shipping');
				}
			}else{
				$this->session->set_flashdata
				('msg','<div class="alert bg-red alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
					<center>Username atau Password Salah</center>
					</div>');
				redirect('controller_login/home');
			}
		}else{
			$username="";
			$password="";
			$query=$this->model_login->cek_username_pass($username,$password);
			if($query->num_rows() != 0){
				foreach($query->result_array() as $data){
					$sess_data['username']="";
					$sess_data['password']="";
					$sess_data['position']="";
					$this->session->set_userdata($sess_data);
				}
			}
		}
	}
	
	public function home(){
		$username="";
		$password="";
		$this->template->load('template_login','view_home');
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect('controller_login/home');
	}
}