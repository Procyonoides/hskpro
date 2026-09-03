<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class controller_production_monitoring extends ci_controller{
    public function __construct(){
		parent:: __construct();
		$this->load->library('datatables');
	}

    public function index($department) {
        $data['title'] = strlen($department) <= 3 ? strtoupper($department) : ucwords($department);
        $data['detail_department_shift'] = $this->model_monitoring->get_chart_department_shift_by_department($data['title']);
        $this->template->load('template_production', 'view_dashboard_production_monitoring', $data);
    }
	
	public function get_data_department($department) {
        $paginate=$_GET['paginate'];
		$data_length=$_GET['data_length'];
		$search=$_GET['search'];
		$sort_column=isset($_GET['sort_column']) ? $_GET['sort_column'] : 'date_time';
    	$sort_direction = isset($_GET['sort_direction']) && strtoupper($_GET['sort_direction']) === 'ASC' ? 'ASC' : 'DESC';
		$data=$this->model_monitoring->get_department_shift_with_paginate($department, $paginate, $data_length, $search, $sort_column, $sort_direction);
		$total=$this->model_monitoring->count_department_shift($department, $search);
		$total_all=$this->model_monitoring->count_department_shift_all($department);
		$total_page=ceil($total / $data_length);
		echo json_encode([
		'WADE'=>$sort_direction,
			'data'=>$data,
			'total'=>$total,
			'paginate'=>$paginate,	
			'length'=>$data_length,
			'total_page'=>$total_page,
			'total_all_data'=>$total_all,
		]);
    }
	
	public function update_data($department){
		$paginate=$_GET['paginate'];
		$data_length=$_GET['data_length'];
		$search=$_GET['search'];
		$sort_column=isset($_GET['sort_column']) ? $_GET['sort_column'] : 'date_time';
    	$sort_direction = isset($_GET['sort_direction']) && strtoupper($_GET['sort_direction']) === 'ASC' ? 'ASC' : 'DESC';
		$data_detail_department_shift = $this->model_monitoring->get_chart_department_shift_by_department($department);
		$data=$this->model_monitoring->get_department_shift_with_paginate($department, $paginate, $data_length, $search, $sort_column, $sort_direction);

        echo json_encode([
			'data_detail_department_shift'=> $data_detail_department_shift,
			'data'=>$data
        ]);
    }
	
	public function print_department_shift($department)
	{
		$shift = $this->input->get('shift');
		$file_date = date('d-m-Y');
		$data['detail'] = $this->model_monitoring->get_department_shift_all($department, $shift);
		$data['shift'] = $shift;
		
		$file_name = "{$file_date}_Shift_" . strtoupper($department) . "_" . ucfirst($shift);
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename={$file_name}.xls");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		$this->load->view('excel_department_shift', $data);
	}
}