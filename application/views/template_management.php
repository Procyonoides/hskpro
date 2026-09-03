<!DOCTYPE html>
<html>
    
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PT HANDAL SUKSES KARYA</title>
	<!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
		folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/jvectormap/jquery-jvectormap.css">
	<!-- Date Picker -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/select2/dist/css/select2.min.css">
  
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<link rel="icon" href="<?php echo base_url();?>assets/dist/img/logo_hsk2.jpg" style="width:50%">
	<?php $array_day=array(1=>'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');$day=$array_day[date('N')];?>
</head>
    
<body class="hold-transition skin-blue sidebar-collapse sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">HSK</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>HSK</b>PRO</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-calendar"></i>
                            <span><?php echo $day.' '.date('Y-m-d') ?></span>
                        </a>
                    </li>
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-clock-o"></i>
                            <span id='time'></span>
                        </a>
                    </li>
                    <!-- Notifications: style can be found in dropdown.less -->
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?php echo base_url();?>assets/dist/img/icon.png" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?php echo $username ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="<?php echo base_url();?>assets/dist/img/icon.png" class="img-circle" alt="User Image">
                                <p>
                                    <?php echo $username ?>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-right">
                                    <a href="<?php echo base_url();?>controller_login/logout" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?php echo base_url();?>assets/dist/img/icon.png" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?php echo $username ?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i>Online</a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MENU</li>
                <li><a href="<?php echo base_url();?>controller_monitoring/dashboard_management"><i class="fa fa-television"></i><span>Stock Monitoring</span></a></li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-file-text"></i><span>Report</span>
                            <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url();?>controller_monitoring/today_management"><i class="fa fa-file-text"></i>Today Report</a></li>
                        <li><a href="<?php echo base_url();?>controller_monitoring/daily_management"><i class="fa fa-file-text"></i>Daily Report</a></li>
                        <li><a href="<?php echo base_url();?>controller_monitoring/monthly_management"><i class="fa fa-file-text"></i>Monthly Report</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo base_url();?>controller_monitoring/stock_management"><i class="fa fa-archive"></i><span>Stock</span></a></li>
            </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">  
            <?php echo $contents;?>
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.0
            </div>
            <strong>Copyright &copy; 2024 <a href="#">HSK IT Department</a>.</strong> All rights reserved.
        </footer>
    </div>
<!-- jQuery 3 -->
<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url();?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="<?php echo base_url();?>assets/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url();?>assets/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url();?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url();?>assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url();?>assets/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url();?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo base_url();?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<!-- Slimscroll -->
<script src="<?php echo base_url();?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url();?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url();?>assets/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>assets/dist/js/demo.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url();?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url();?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url();?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url();?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url();?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url();?>assets/bower_components/chart.js/Chart.js"></script>
<!-- ChartJS 2-->
<script src="<?php echo base_url();?>assets/plugins/chartjs/chart.js"></script>
<!-- Counter -->
<script src="<?php echo base_url();?>assets/bower_components/counter/script.js"></script>

<script>
	$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()
    //Date range picker daily
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ 	
		timePicker: true,
		timePickerIncrement: 30,
		timePicker24Hour: true,
		startDate: moment().startOf('hour'),
		endDate: moment().startOf('hour').add(32, 'hour'),
		locale: {
			format: 'MM/DD/YYYY HH:mm'
		}
	})
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()
    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>

<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>

<script>
	$(document).ready(function(){
		//setup datatables barcode
		$.fn.dataTableExt.oApi.fnPagingInfo=function(oSettings)
		{
			return {
				"iStart": oSettings._iDisplayStart,
				"iEnd": oSettings.fnDisplayEnd(),
				"iLength": oSettings._iDisplayLength,
				"iTotal": oSettings.fnRecordsTotal(),
				"iFilteredTotal": oSettings.fnRecordsDisplay(),
				"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
				"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
			};
		};

		var table=$("#mytable").dataTable({
			initComplete: function() {
				var api=this.api();
				$('#mytable_filter input')
				.off('.DT')
				.on('input.DT', function() {
					api.search(this.value).draw();
				});
			},
			oLanguage: {
				sProcessing: "loading..."
			},
			processing: true,
			serverSide: true,
			ajax: {"url": "<?php echo base_url().'controller_monitoring/get_guest_json_barcode'?>", "type": "POST"},
			columns: [
			{"data": "original_barcode"},
			{"data": "brand"},
			{"data": "color"},
			{"data": "size"},
			{"data": "four_digit"},
			{"data": "unit"},
			{"data": "quantity"},
			{"data": "customer"},
			{"data": "cust_model"},
			{"data": "model_code"},
			{"data": "item"},
			{"data": "user"},
			{"data": "date"},
			{"data": "stock"},
			{"data": "view"}
			],
			order: [[12, 'desc']],
			rowCallback: function(row, data, iDisplayIndex) {
				var info=this.fnPagingInfo();
				var page=info.iPage;
				var length=info.iLength;
				$('td:eq(0)', row).html();
			}
		});
		//end setup datatables
		
		//get edit barcode
		$('#mytable').on('click','.edit_record',function(){
			var barcode=$(this).data('barcode');
			$.ajax({
				type : "GET",
				url  : "<?php echo base_url('controller_monitoring/get_barcode')?>",
				dataType : "JSON",
				data : {barcode:barcode},
				success: function(data){
					$.each(data,function(original_barcode, brand, color, size, four_digit, unit, quantity, customer, cust_model, model_code, item, user, date, stock){
						$('#ModalUpdate').modal('show');
						$('[name="barcode_edit"]').val(data.original_barcode);
						$('[name="brand_edit"]').val(data.brand);
						$('[name="color_edit"]').val(data.color);
						$('[name="size_edit"]').val(data.size);
						$('[name="digit_edit"]').val(data.four_digit);
						$('[name="unit_edit"]').val(data.unit);
						$('[name="quantity_edit"]').val(data.quantity);
						$('[name="customer_edit"]').val(data.customer);
						$('[name="cust_edit"]').val(data.cust_model);
						$('[name="model_edit"]').val(data.model_code);
						$('[name="item_edit"]').val(data.item);
						$('[name="user_edit"]').val(data.user);
						$('[name="date_edit"]').val(data.date);
						$('[name="stock_edit"]').val(data.stock);
					});
				}
			});
			return false;
		});
		//end get edit barcode
		
		//get delete barcode
		$('#mytable').on('click','.delete_record',function(){
			var barcode=$(this).data('barcode');
			$('#ModalDelete').modal('show');
			$('[name="barcode"]').val(barcode);
		});
		//end get delete barcode
	});
</script>
	
<script>
	$(document).ready(function(){
		//setup datatables receiving
		$.fn.dataTableExt.oApi.fnPagingInfo=function(oSettings)
		{
			return {
				"iStart": oSettings._iDisplayStart,
				"iEnd": oSettings.fnDisplayEnd(),
				"iLength": oSettings._iDisplayLength,
				"iTotal": oSettings.fnRecordsTotal(),
				"iFilteredTotal": oSettings.fnRecordsDisplay(),
				"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
				"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
			};
		};

		var table=$("#mytable2").dataTable({
			initComplete: function() {
				var api=this.api();
				$('#mytable_filter input')
				.off('.DT')
				.on('input.DT', function() {
					api.search(this.value).draw();
				});
			},
			oLanguage: {
				sProcessing: "loading..."
			},
			processing: true,
			serverSide: true,
			ajax: {"url": "<?php echo base_url().'controller_scan/get_guest_json_rec'?>", "type": "POST"},
			columns: [
			{"data": "date_time"},
			{"data": "brand"},
			{"data": "cust_model"},
			{"data": "color"},
			{"data": "size"},
			{"data": "quantity"},
			{"data": "username"},
			{"data": "scan_no"},
			{"data": "view"}
			],
			order: [[0, 'desc']],
			rowCallback: function(row, data, iDisplayIndex) {
				var info=this.fnPagingInfo();
				var page=info.iPage;
				var length=info.iLength;
				$('td:eq(0)', row).html();
			}
		});
		//end setup datatables
		
		//get edit receiving
		$('#mytable2').on('click','.edit_record',function(){
			var date=$(this).data('date');
			var scan=$(this).data('scan');
			var user=$(this).data('user');
			$.ajax({
				type : "GET",
				url  : "<?php echo base_url('controller_scan/get_barcode_rec')?>",
				dataType : "JSON",
				data : {date:date, scan:scan, user:user},
				success: function(data){
					$.each(data,function(original_barcode, brand, color, size, four_digit, unit, quantity, customer, cust_model, model_code, item, date_time, scan_no, username){
						$('#ModalUpdate').modal('show');
						$('[name="barcode_edit"]').val(data.original_barcode);
						$('[name="brand_edit"]').val(data.brand);
						$('[name="color_edit"]').val(data.color);
						$('[name="size_edit"]').val(data.size);
						$('[name="digit_edit"]').val(data.four_digit);
						$('[name="unit_edit"]').val(data.unit);
						$('[name="quantity_edit"]').val(data.quantity);
						$('[name="customer_edit"]').val(data.customer);
						$('[name="cust_edit"]').val(data.cust_model);
						$('[name="model_edit"]').val(data.model_code);
						$('[name="item_edit"]').val(data.item);
						$('[name="date_edit"]').val(data.date_time);
						$('[name="scan_edit"]').val(data.scan_no);
						$('[name="username_edit"]').val(data.username);
						$('[name="user"]').val(data.username);
					});
				}
			});
			return false;
		});
		//end get edit receiving
		
		//get delete receiving
		$('#mytable2').on('click','.delete_record',function(){
			var date=$(this).data('date');
			var scan=$(this).data('scan');
			var user=$(this).data('user');
			$('#ModalDelete').modal('show');
			$('[name="date"]').val(date);
			$('[name="scan"]').val(scan);
			$('[name="user"]').val(user);
		});
		//end get delete receiving
	});
</script>

<script>
	$(document).ready(function(){
		//setup datatables shipping
		$.fn.dataTableExt.oApi.fnPagingInfo=function(oSettings)
		{
			return {
				"iStart": oSettings._iDisplayStart,
				"iEnd": oSettings.fnDisplayEnd(),
				"iLength": oSettings._iDisplayLength,
				"iTotal": oSettings.fnRecordsTotal(),
				"iFilteredTotal": oSettings.fnRecordsDisplay(),
				"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
				"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
			};
		};

		var table=$("#mytable3").dataTable({
			initComplete: function() {
				var api=this.api();
				$('#mytable_filter input')
				.off('.DT')
				.on('input.DT', function() {
					api.search(this.value).draw();
				});
			},
			oLanguage: {
				sProcessing: "loading..."
			},
			processing: true,
			serverSide: true,
			ajax: {"url": "<?php echo base_url().'controller_scan/get_guest_json_shi'?>", "type": "POST"},
			columns: [
			{"data": "date_time"},
			{"data": "brand"},
			{"data": "cust_model"},
			{"data": "color"},
			{"data": "size"},
			{"data": "quantity"},
			{"data": "username"},
			{"data": "scan_no"},
			{"data": "view"}
			],
			order: [[0, 'desc']],
			rowCallback: function(row, data, iDisplayIndex) {
				var info=this.fnPagingInfo();
				var page=info.iPage;
				var length=info.iLength;
				$('td:eq(0)', row).html();
			}
		});
		//end setup datatables
		
		//get edit shipping
		$('#mytable3').on('click','.edit_record',function(){
			var date=$(this).data('date');
			var scan=$(this).data('scan');
			var user=$(this).data('user');
			$.ajax({
				type : "GET",
				url  : "<?php echo base_url('controller_scan/get_barcode_shi')?>",
				dataType : "JSON",
				data : {date:date, scan:scan, user:user},
				success: function(data){
					$.each(data,function(original_barcode, brand, color, size, four_digit, unit, quantity, customer, cust_model, model_code, item, date_time, scan_no, username){
						$('#ModalUpdate').modal('show');
						$('[name="barcode_edit"]').val(data.original_barcode);
						$('[name="brand_edit"]').val(data.brand);
						$('[name="color_edit"]').val(data.color);
						$('[name="size_edit"]').val(data.size);
						$('[name="digit_edit"]').val(data.four_digit);
						$('[name="unit_edit"]').val(data.unit);
						$('[name="quantity_edit"]').val(data.quantity);
						$('[name="customer_edit"]').val(data.customer);
						$('[name="cust_edit"]').val(data.cust_model);
						$('[name="model_edit"]').val(data.model_code);
						$('[name="item_edit"]').val(data.item);
						$('[name="date_edit"]').val(data.date_time);
						$('[name="scan_edit"]').val(data.scan_no);
						$('[name="username_edit"]').val(data.username);
						$('[name="user"]').val(data.username);
					});
				}
			});
			return false;
		});
		//end get edit shipping
		
		//get delete shipping
		$('#mytable3').on('click','.delete_record',function(){
			var date=$(this).data('date');
			var scan=$(this).data('scan');
			var user=$(this).data('user');
			$('#ModalDelete').modal('show');
			$('[name="date"]').val(date);
			$('[name="scan"]').val(scan);
			$('[name="user"]').val(user);
		});
		//end get delete shipping
	});
</script>

<script>
	$(document).ready(function(){
		//setup datatables user
		$.fn.dataTableExt.oApi.fnPagingInfo=function(oSettings)
		{
			return {
				"iStart": oSettings._iDisplayStart,
				"iEnd": oSettings.fnDisplayEnd(),
				"iLength": oSettings._iDisplayLength,
				"iTotal": oSettings.fnRecordsTotal(),
				"iFilteredTotal": oSettings.fnRecordsDisplay(),
				"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
				"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
			};
		};

		var table=$("#mytable4").dataTable({
			initComplete: function() {
				var api=this.api();
				$('#mytable_filter input')
				.off('.DT')
				.on('input.DT', function() {
					api.search(this.value).draw();
				});
			},
			oLanguage: {
				sProcessing: "loading..."
			},
			processing: true,
			serverSide: true,
			ajax: {"url": "<?php echo base_url().'controller_user/get_guest_json_user'?>", "type": "POST"},
			columns: [
			{"data": "id_user"},
			{"data": "position"},
			{"data": "username"},
			{"data": "password"},
			{"data": "view"}
			],
			order: [[0, 'desc']],
			rowCallback: function(row, data, iDisplayIndex) {
				var info=this.fnPagingInfo();
				var page=info.iPage;
				var length=info.iLength;
				$('td:eq(0)', row).html();
			}
		});
		//end setup datatables
		
		//get edit user
		$('#mytable4').on('click','.edit_record',function(){
			var id=$(this).data('id');
			$.ajax({
				type : "GET",
				url  : "<?php echo base_url('controller_user/get_user')?>",
				dataType : "JSON",
				data : {id_user:id},
				success: function(data){
					$.each(data,function(id_user, username, password){
						$('#ModalUpdate').modal('show');
						$('[name="id_user_edit"]').val(data.id_user);
						$('[name="username_edit"]').val(data.username);
						$('[name="password_edit"]').val(data.password);
					});
				}
			});
			return false;
		});
		//end get edit user
		
		//get delete user
		$('#mytable4').on('click','.delete_record',function(){
			var id=$(this).data('id');
			$('#ModalDelete').modal('show');
			$('[name="id"]').val(id);
		});
		//end get delete user
	});
</script>

<script>
	$(document).ready(function(){
		//setup datatables transaction
		$.fn.dataTableExt.oApi.fnPagingInfo=function(oSettings)
		{
			return {
				"iStart": oSettings._iDisplayStart,
				"iEnd": oSettings.fnDisplayEnd(),
				"iLength": oSettings._iDisplayLength,
				"iTotal": oSettings.fnRecordsTotal(),
				"iFilteredTotal": oSettings.fnRecordsDisplay(),
				"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
				"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
			};
		};

		var table=$("#mytable5").dataTable({
			initComplete: function() {
				var api=this.api();
				$('#mytable_filter input')
				.off('.DT')
				.on('input.DT', function() {
					api.search(this.value).draw();
				});
			},
			oLanguage: {
				sProcessing: "loading..."
			},
			processing: true,
			serverSide: true,
			ajax: {"url": "<?php echo base_url().'controller_monitoring/get_guest_json_trans'?>", "type": "POST"},
			columns: [
			{"data": "date"},
			{"data": "stock_awal"},
			{"data": "receiving"},
			{"data": "shipping"},
			{"data": "stock_akhir"},
			{"data": "view"}
			],
			order: [[0, 'asc']],
			rowCallback: function(row, data, iDisplayIndex) {
				var info=this.fnPagingInfo();
				var page=info.iPage;
				var length=info.iLength;
				$('td:eq(0)', row).html();
			}
		});
		//end setup datatables
		
		//get edit transaction
		$('#mytable5').on('click','.edit_record',function(){
			var no=$(this).data('no');
			$.ajax({
				type : "GET",
				url  : "<?php echo base_url('controller_monitoring/get_trans')?>",
				dataType : "JSON",
				data : {no:no},
				success: function(data){
					$.each(data,function(no, stock_awal, receiving, shipping, stock_akhir, date){
						$('#ModalUpdate').modal('show');
						$('[name="no_edit"]').val(data.no);
						$('[name="awal_edit"]').val(data.stock_awal);
						$('[name="receiving_edit"]').val(data.receiving);
						$('[name="shipping_edit"]').val(data.shipping);
						$('[name="akhir_edit"]').val(data.stock_akhir);
						$('[name="tanggal_edit"]').val(data.date);
					});
				}
			});
			return false;
		});
		//end get edit transaction
		
		//get delete transaction
		$('#mytable5').on('click','.delete_record',function(){
			var no=$(this).data('no');
			$('#ModalDelete').modal('show');
			$('[name="no"]').val(no);
		});
		//end get delete transaction
	});
</script>

<script>
	$(document).ready(function(){
		//setup datatables delivery
		$.fn.dataTableExt.oApi.fnPagingInfo=function(oSettings)
		{
			return {
				"iStart": oSettings._iDisplayStart,
				"iEnd": oSettings.fnDisplayEnd(),
				"iLength": oSettings._iDisplayLength,
				"iTotal": oSettings.fnRecordsTotal(),
				"iFilteredTotal": oSettings.fnRecordsDisplay(),
				"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
				"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
			};
		};

		var table=$("#mytable6").dataTable({
			initComplete: function() {
				var api=this.api();
				$('#mytable_filter input')
				.off('.DT')
				.on('input.DT', function() {
					api.search(this.value).draw();
				});
			},
			oLanguage: {
				sProcessing: "loading..."
			},
			processing: true,
			serverSide: true,
			ajax: {"url": "<?php echo base_url().'stock_monitoring/get_json_delivery'?>", "type": "POST"},
			columns: [
			{"data": "delivery_number"},
			{"data": "seal_number"},
			{"data": "date"},
			{"data": "shipping_for"},
			{"data": "number_for_vehicle"},
			{"data": "user"},
			{"data": "created_at"},
			{"data": "total"},
			{"data": "view"}
			],
			order: [[0, 'asc']],
			rowCallback: function(row, data, iDisplayIndex) {
				var info=this.fnPagingInfo();
				var page=info.iPage;
				var length=info.iLength;
				$('td:eq(0)', row).html();
			}
		});
		//end setup datatables
		
		//get edit delivery
		$('#mytable6').on('click','.edit_record',function(){
			var no=$(this).data('no');
			$.ajax({
				type : "GET",
				url  : "<?php echo base_url('stock_monitoring/')?>",
				dataType : "JSON",
				data : {no:no},
				success: function(data){
					$.each(data,function(no, stock_awal, receiving, shipping, stock_akhir, date){
						$('#ModalUpdate').modal('show');
						$('[name="no_edit"]').val(data.no);
						$('[name="awal_edit"]').val(data.stock_awal);
						$('[name="receiving_edit"]').val(data.receiving);
						$('[name="shipping_edit"]').val(data.shipping);
						$('[name="akhir_edit"]').val(data.stock_akhir);
						$('[name="tanggal_edit"]').val(data.date);
					});
				}
			});
			return false;
		});
		//end get edit delivery
		
		//get delete delivery
		$('#mytable6').on('click','.delete_record',function(){
			var delivery2=$(this).data('delivery1');
			$('#ModalDelete').modal('show');
			$('[name="delivery3"]').val(delivery2);
		});
		//end get delete delivery
	});
</script>

<script>
	$(document).ready(function(){
		//setup datatables barcode
		$.fn.dataTableExt.oApi.fnPagingInfo=function(oSettings)
		{
			return {
				"iStart": oSettings._iDisplayStart,
				"iEnd": oSettings.fnDisplayEnd(),
				"iLength": oSettings._iDisplayLength,
				"iTotal": oSettings.fnRecordsTotal(),
				"iFilteredTotal": oSettings.fnRecordsDisplay(),
				"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
				"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
			};
		};

		var table=$("#mytable7").dataTable({
			initComplete: function() {
				var api=this.api();
				$('#mytable_filter input')
				.off('.DT')
				.on('input.DT', function() {
					api.search(this.value).draw();
				});
			},
			oLanguage: {
				sProcessing: "loading..."
			},
			processing: true,
			serverSide: true,
			ajax: {"url": "<?php echo base_url().'controller_monitoring/get_guest_json_record'?>", "type": "POST"},
			columns: [
			{"data": "original_barcode"},
			{"data": "brand"},
			{"data": "color"},
			{"data": "size"},
			{"data": "four_digit"},
			{"data": "unit"},
			{"data": "quantity"},
			{"data": "customer"},
			{"data": "cust_model"},
			{"data": "model_code"},
			{"data": "item"},
			{"data": "date_time"},
			{"data": "scan_no"},
			{"data": "username"},
			{"data": "view"}
			],
			order: [[11, 'desc']],
			rowCallback: function(row, data, iDisplayIndex) {
				var info=this.fnPagingInfo();
				var page=info.iPage;
				var length=info.iLength;
				$('td:eq(0)', row).html();
			}
		});
		//end setup datatables
		
		//get edit barcode
		$('#mytable').on('click','.edit_record',function(){
			var barcode=$(this).data('barcode');
			$.ajax({
				type : "GET",
				url  : "<?php echo base_url('controller_monitoring/get_barcode')?>",
				dataType : "JSON",
				data : {barcode:barcode},
				success: function(data){
					$.each(data,function(original_barcode, brand, color, size, four_digit, unit, quantity, customer, cust_model, model_code, item, user, date, stock){
						$('#ModalUpdate').modal('show');
						$('[name="barcode_edit"]').val(data.original_barcode);
						$('[name="brand_edit"]').val(data.brand);
						$('[name="color_edit"]').val(data.color);
						$('[name="size_edit"]').val(data.size);
						$('[name="digit_edit"]').val(data.four_digit);
						$('[name="unit_edit"]').val(data.unit);
						$('[name="quantity_edit"]').val(data.quantity);
						$('[name="customer_edit"]').val(data.customer);
						$('[name="cust_edit"]').val(data.cust_model);
						$('[name="model_edit"]').val(data.model_code);
						$('[name="item_edit"]').val(data.item);
						$('[name="user_edit"]').val(data.user);
						$('[name="date_edit"]').val(data.date);
						$('[name="stock_edit"]').val(data.stock);
					});
				}
			});
			return false;
		});
		//end get edit barcode
		
		//get delete barcode
		$('#mytable').on('click','.delete_record',function(){
			var barcode=$(this).data('barcode');
			$('#ModalDelete').modal('show');
			$('[name="barcode"]').val(barcode);
		});
		//end get delete barcode
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		//GET UPDATE
		$('.update-record').on('click',function(){
			var original_barcode = $(this).data('original_barcode');
			var brand = $(this).data('brand');
			var color = $(this).data('color');
			var size = $(this).data('size');
			var four_digit = $(this).data('four_digit');
			var unit = $(this).data('unit');
			var quantity = $(this).data('quantity');
			var customer = $(this).data('customer');
			var cust_model = $(this).data('cust_model');
			var model_code = $(this).data('model_code');
			var item = $(this).data('item');
			var date_time = $(this).data('date_time');
			var scan_no = $(this).data('scan_no');
			var username = $(this).data('username');
				$(".strings").val('');
				$('#ModalUpdate').modal('show');
				$('[name="barcode_edit"]').val(original_barcode);
				$('[name="brand_edit"]').val(brand);
				$('[name="color_edit"]').val(color);
				$('[name="size_edit"]').val(size);
				$('[name="digit_edit"]').val(four_digit);
				$('[name="unit_edit"]').val(unit);
				$('[name="quantity_edit"]').val(quantity);
				$('[name="customer_edit"]').val(customer);
				$('[name="cust_edit"]').val(cust_model);
				$('[name="model_edit"]').val(model_code);
				$('[name="item_edit"]').val(item);
				$('[name="date_edit"]').val(date_time);
				$('[name="scan_edit"]').val(scan_no);
				$('[name="username_edit"]').val(username);
				$('[name="user"]').val(username);
		});

		//GET CONFIRM DELETE
		$('.delete-record').on('click',function(){
			var date = $(this).data('date');
			var scan = $(this).data('scan');
			var user = $(this).data('user');
			$('#ModalDelete').modal('show');
			$('[name="date"]').val(date);
			$('[name="scan"]').val(scan);
			$('[name="user"]').val(user);
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#barcode').on('input',function(){  
			var barcode=$(this).val();
			$.ajax({
				type : "POST",
				url  : "<?php echo base_url('controller_scan/get_code')?>",
				dataType : "JSON",
				data : {barcode: barcode},
				cache:false,
				success: function(data){
					$.each(data,function(original_barcode, brand, color, size, four_digit, unit, quantity, customer, cust_model, model_code, item){
						$('[name="brand_edit"]').val(data.brand);
						$('[name="color_edit"]').val(data.color);
						$('[name="size_edit"]').val(data.size);
						$('[name="digit_edit"]').val(data.four_digit);
						$('[name="unit_edit"]').val(data.unit);
						$('[name="quantity_edit"]').val(data.quantity);
						$('[name="customer_edit"]').val(data.customer);
						$('[name="cust_edit"]').val(data.cust_model);
						$('[name="model_edit"]').val(data.model_code);
						$('[name="item_edit"]').val(data.item);
					});	
				}
			});
			return false;
		});
	});
</script>

<script>
	//Alert
	window.setTimeout(function() {
		$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
		});
	}, 5000);
</script>

<script>
	//Counter
    $('.count').each(function () {
    $(this).prop('Counter', 0).animate({
            Counter: $(this).data('value')
        }, {
        duration: 1000,
        easing: 'swing',
        step: function (now) {                      
            $(this).text(this.Counter.toFixed());
        }
    });
    });
</script>

<script>
	//Timer
	function display_ct7() {
		var x = new Date()
		var ampm = x.getHours( ) >= 12 ? ' PM' : ' AM';
		hours = x.getHours( ) % 12;
		hours = hours ? hours : 12;
		hours=hours.toString().length==1? 0+hours.toString() : hours;

		var minutes=x.getMinutes().toString()
		minutes=minutes.length==1 ? 0+minutes : minutes;

		var seconds=x.getSeconds().toString()
		seconds=seconds.length==1 ? 0+seconds : seconds;

		var month=(x.getMonth() +1).toString();
		month=month.length==1 ? 0+month : month;

		var dt=x.getDate().toString();
		dt=dt.length==1 ? 0+dt : dt;

		var x1=month + "/" + dt + "/" + x.getFullYear(); 
		x1 = hours + ":" +  minutes + ":" +  seconds + " " + ampm;
		document.getElementById('time').innerHTML = x1;
		display_c7();
	}
		
	function display_c7() {
		var refresh=1000; // Refresh rate in milli seconds
		mytime=setTimeout('display_ct7()',refresh)
	}
	display_c7()
</script>

<script>
	//Daily Chart
	var ctx=document.getElementById("canvas_daily").getContext('2d');
	var myChart=new Chart(ctx, {
    type: 'line',
    data: {
		labels: <?php foreach($detail_daily as $data){ $tgl[]=$data->Tanggal; } echo json_encode($tgl); ?>,
			datasets: [{
			label: 'RECEIVING',
			data: <?php foreach($detail_daily as $data){ $rec[]=$data->Receiving; } echo json_encode($rec); ?>,
			lineTension: 0,
			fill: false,
			borderColor: '#00a65a',
			backgroundColor: 'transparent',
			borderDash: [10, 2],
			pointBorderColor: '#00a65a',
			pointBackgroundColor: '#3cb371',
			pointRadius: 5,
			pointHoverRadius: 10,
			pointHitRadius: 30,
			pointBorderWidth: 2,
			pointStyle: 'rectRounded'
			},{
			label: 'SHIPPING',
			data : <?php foreach($detail_daily as $data){ $shi[]=$data->Shipping; } echo json_encode($shi); ?>,
			lineTension: 0,
			fill: false,
			borderColor: '#f39c12',
			backgroundColor: 'transparent',
			borderDash: [10, 2],
			pointBorderColor: '#f39c12',
			pointBackgroundColor: '#daa520',
			pointRadius: 5,
			pointHoverRadius: 10,
			pointHitRadius: 30,
			pointBorderWidth: 2,
			pointStyle: 'rectRounded'
		}]
		},
		options: {
		scales: {
			yAxes: [{
			ticks: {
            beginAtZero:true
			}
		}]
		}
		}
	});
</script>

</body>

</html>