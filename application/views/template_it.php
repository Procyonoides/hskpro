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
                <li><a href="<?php echo base_url();?>controller_monitoring/dashboard_it"><i class="fa fa-television"></i><span>Stock Monitoring</span></a></li>
                <li><a href="<?php echo base_url();?>controller_scan/receiving_it"><i class="fa fa-arrow-down"></i><span>Scan Receiving</span></a></li>
                <li><a href="<?php echo base_url();?>controller_scan/shipping_it"><i class="fa fa-arrow-up"></i><span>Scan Shipping</span></a></li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-file-text"></i><span>Report</span>
                            <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url();?>controller_monitoring/daily_it"><i class="fa fa-file-text"></i>Daily Report</a></li>
                        <li><a href="<?php echo base_url();?>controller_monitoring/monthly_it"><i class="fa fa-file-text"></i>Monthly Report</a></li>
                    </ul>
                </li>
				<li><a href="<?php echo base_url();?>controller_monitoring/master"><i class="fa fa-cloud"></i><span>Master Data</span></a></li>
                <li><a href="<?php echo base_url();?>controller_monitoring/transaction"><i class="fa fa-bar-chart"></i><span>Transaction</span></a></li>
				<!--<li><a href="<?php echo base_url();?>stock_monitoring/deliver"><i class="fa fa-truck"></i><span>Delivery Product</span></a></li>-->
				<!--<li><a href="<?php echo base_url();?>stock_monitoring/generate"><i class="fa fa-barcode"></i><span>Generate</span></a></li>-->
                <li><a href="<?php echo base_url();?>controller_monitoring/stock_it"><i class="fa fa-archive"></i><span>Stock</span></a></li>
                <!--<li><a href="<?php echo base_url();?>controller_monitoring/deliv"><i class="fa fa-road"></i><span>Delivery</span></a></li>-->
                <li><a href="<?php echo base_url();?>controller_user/user"><i class="fa fa-user"></i><span>User</span></a></li>
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
<!-- jQuery Knob -->
<script src="<?php echo base_url();?>assets/bower_components/jquery-knob/js/jquery.knob.js"></script>
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
	$('#reservation1').daterangepicker()
    $('#reservation2').daterangepicker()
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
    /* jQueryKnob */

    $(".knob").knob({
      /*change : function (value) {
       //console.log("change : " + value);
       },
       release : function (value) {
       console.log("release : " + value);
       },
       cancel : function () {
       console.log("cancel : " + this.value);
       },*/
      draw: function () {

        // "tron" case
        if (this.$.data('skin') == 'tron') {

          var a = this.angle(this.cv)  // Angle
              , sa = this.startAngle          // Previous start angle
              , sat = this.startAngle         // Start angle
              , ea                            // Previous end angle
              , eat = sat + a                 // End angle
              , r = true;

          this.g.lineWidth = this.lineWidth;

          this.o.cursor
          && (sat = eat - 0.3)
          && (eat = eat + 0.3);

          if (this.o.displayPrevious) {
            ea = this.startAngle + this.angle(this.value);
            this.o.cursor
            && (sa = ea - 0.3)
            && (ea = ea + 0.3);
            this.g.beginPath();
            this.g.strokeStyle = this.previousColor;
            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
            this.g.stroke();
          }

          this.g.beginPath();
          this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
          this.g.stroke();

          this.g.lineWidth = 2;
          this.g.beginPath();
          this.g.strokeStyle = this.o.fgColor;
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
          this.g.stroke();

          return false;
        }
      }
    });
    /* END JQUERY KNOB */

    //INITIALIZE SPARKLINE CHARTS
    $(".sparkline").each(function () {
      var $this = $(this);
      $this.sparkline('html', $this.data());
    });

    /* SPARKLINE DOCUMENTATION EXAMPLES http://omnipotent.net/jquery.sparkline/#s-about */
    drawDocSparklines();
    drawMouseSpeedDemo();

  });
  function drawDocSparklines() {

    // Bar + line composite charts
    $('#compositebar').sparkline('html', {type: 'bar', barColor: '#aaf'});
    $('#compositebar').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7],
        {composite: true, fillColor: false, lineColor: 'red'});


    // Line charts taking their values from the tag
    $('.sparkline-1').sparkline();

    // Larger line charts for the docs
    $('.largeline').sparkline('html',
        {type: 'line', height: '2.5em', width: '4em'});

    // Customized line chart
    $('#linecustom').sparkline('html',
        {
          height: '1.5em', width: '8em', lineColor: '#f00', fillColor: '#ffa',
          minSpotColor: false, maxSpotColor: false, spotColor: '#77f', spotRadius: 3
        });

    // Bar charts using inline values
    $('.sparkbar').sparkline('html', {type: 'bar'});

    $('.barformat').sparkline([1, 3, 5, 3, 8], {
      type: 'bar',
      tooltipFormat: '{{value:levels}} - {{value}}',
      tooltipValueLookups: {
        levels: $.range_map({':2': 'Low', '3:6': 'Medium', '7:': 'High'})
      }
    });

    // Tri-state charts using inline values
    $('.sparktristate').sparkline('html', {type: 'tristate'});
    $('.sparktristatecols').sparkline('html',
        {type: 'tristate', colorMap: {'-2': '#fa7', '2': '#44f'}});

    // Composite line charts, the second using values supplied via javascript
    $('#compositeline').sparkline('html', {fillColor: false, changeRangeMin: 0, chartRangeMax: 10});
    $('#compositeline').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7],
        {composite: true, fillColor: false, lineColor: 'red', changeRangeMin: 0, chartRangeMax: 10});

    // Line charts with normal range marker
    $('#normalline').sparkline('html',
        {fillColor: false, normalRangeMin: -1, normalRangeMax: 8});
    $('#normalExample').sparkline('html',
        {fillColor: false, normalRangeMin: 80, normalRangeMax: 95, normalRangeColor: '#4f4'});

    // Discrete charts
    $('.discrete1').sparkline('html',
        {type: 'discrete', lineColor: 'blue', xwidth: 18});
    $('#discrete2').sparkline('html',
        {type: 'discrete', lineColor: 'blue', thresholdColor: 'red', thresholdValue: 4});

    // Bullet charts
    $('.sparkbullet').sparkline('html', {type: 'bullet'});

    // Pie charts
    $('.sparkpie').sparkline('html', {type: 'pie', height: '1.0em'});

    // Box plots
    $('.sparkboxplot').sparkline('html', {type: 'box'});
    $('.sparkboxplotraw').sparkline([1, 3, 5, 8, 10, 15, 18],
        {type: 'box', raw: true, showOutliers: true, target: 6});

    // Box plot with specific field order
    $('.boxfieldorder').sparkline('html', {
      type: 'box',
      tooltipFormatFieldlist: ['med', 'lq', 'uq'],
      tooltipFormatFieldlistKey: 'field'
    });

    // click event demo sparkline
    $('.clickdemo').sparkline();
    $('.clickdemo').bind('sparklineClick', function (ev) {
      var sparkline = ev.sparklines[0],
          region = sparkline.getCurrentRegionFields();
      value = region.y;
      alert("Clicked on x=" + region.x + " y=" + region.y);
    });

    // mouseover event demo sparkline
    $('.mouseoverdemo').sparkline();
    $('.mouseoverdemo').bind('sparklineRegionChange', function (ev) {
      var sparkline = ev.sparklines[0],
          region = sparkline.getCurrentRegionFields();
      value = region.y;
      $('.mouseoverregion').text("x=" + region.x + " y=" + region.y);
    }).bind('mouseleave', function () {
      $('.mouseoverregion').text('');
    });
  }

  /**
   ** Draw the little mouse speed animated graph
   ** This just attaches a handler to the mousemove event to see
   ** (roughly) how far the mouse has moved
   ** and then updates the display a couple of times a second via
   ** setTimeout()
   **/
  function drawMouseSpeedDemo() {
    var mrefreshinterval = 500; // update display every 500ms
    var lastmousex = -1;
    var lastmousey = -1;
    var lastmousetime;
    var mousetravel = 0;
    var mpoints = [];
    var mpoints_max = 30;
    $('html').mousemove(function (e) {
      var mousex = e.pageX;
      var mousey = e.pageY;
      if (lastmousex > -1) {
        mousetravel += Math.max(Math.abs(mousex - lastmousex), Math.abs(mousey - lastmousey));
      }
      lastmousex = mousex;
      lastmousey = mousey;
    });
    var mdraw = function () {
      var md = new Date();
      var timenow = md.getTime();
      if (lastmousetime && lastmousetime != timenow) {
        var pps = Math.round(mousetravel / (timenow - lastmousetime) * 1000);
        mpoints.push(pps);
        if (mpoints.length > mpoints_max)
          mpoints.splice(0, 1);
        mousetravel = 0;
        $('#mousespeed').sparkline(mpoints, {width: mpoints.length * 2, tooltipSuffix: ' pixels per second'});
      }
      lastmousetime = timenow;
      setTimeout(mdraw, mrefreshinterval);
    };
    // We could use setInterval instead, but I prefer to do it this way
    setTimeout(mdraw, mrefreshinterval);
  }
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
			{"data": "production"},
			{"data": "model"},
			{"data": "model_code"},
			{"data": "item"},
			{"data": "username"},
			{"data": "date_time"},
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
		//end setup datatables barcode
		
		//get edit barcode
		$('#mytable').on('click','.edit_record',function(){
			var barcode=$(this).data('barcode');
			$.ajax({
				type : "GET",
				url  : "<?php echo base_url('controller_monitoring/get_barcode')?>",
				dataType : "JSON",
				data : {barcode:barcode},
				success: function(data){
					$.each(data,function(original_barcode, brand, color, size, four_digit, unit, quantity, production, model, model_code, item, username, date_time, stock){
						$('#ModalUpdate').modal('show');
						$('[name="barcode_edit"]').val(data.original_barcode);
						$('[name="brand_edit"]').val(data.brand);
						$('[name="color_edit"]').val(data.color);
						$('[name="size_edit"]').val(data.size);
						$('[name="digit_edit"]').val(data.four_digit);
						$('[name="unit_edit"]').val(data.unit);
						$('[name="quantity_edit"]').val(data.quantity);
						$('[name="production_edit"]').val(data.production);
						$('[name="model_edit"]').val(data.model);
						$('[name="code_edit"]').val(data.model_code);
						$('[name="item_edit"]').val(data.item);
						$('[name="username_edit"]').val(data.username);
						$('[name="date_edit"]').val(data.date_time);
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
			{"data": "original_barcode"},
			{"data": "brand"},
			{"data": "model"},
			{"data": "color"},
			{"data": "size"},
			{"data": "quantity"},
			{"data": "username"},
			{"data": "description"},
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
		//end setup datatables receiving
		
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
					$.each(data,function(original_barcode, brand, color, size, four_digit, unit, quantity, production, model, model_code, item, date_time, scan_no, username, description){
						$('#ModalUpdate').modal('show');
						$('[name="barcode_edit"]').val(data.original_barcode);
						$('[name="brand_edit"]').val(data.brand);
						$('[name="color_edit"]').val(data.color);
						$('[name="size_edit"]').val(data.size);
						$('[name="digit_edit"]').val(data.four_digit);
						$('[name="unit_edit"]').val(data.unit);
						$('[name="quantity_edit"]').val(data.quantity);
						$('[name="production_edit"]').val(data.production);
						$('[name="model_edit"]').val(data.model);
						$('[name="code_edit"]').val(data.model_code);
						$('[name="item_edit"]').val(data.item);
						$('[name="date_edit"]').val(data.date_time);
						$('[name="scan_edit"]').val(data.scan_no);
						$('[name="username_edit"]').val(data.username);
						$('[name="user"]').val(data.username);
						$('[name="description_edit"]').val(data.description);
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
			{"data": "original_barcode"},
			{"data": "brand"},
			{"data": "model"},
			{"data": "color"},
			{"data": "size"},
			{"data": "quantity"},
			{"data": "username"},
			{"data": "description"},
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
		//end setup datatables shipping
		
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
					$.each(data,function(original_barcode, brand, color, size, four_digit, unit, quantity, production, cust_model, model_code, item, date_time, scan_no, username, description){
						$('#ModalUpdate').modal('show');
						$('[name="barcode_edit"]').val(data.original_barcode);
						$('[name="brand_edit"]').val(data.brand);
						$('[name="color_edit"]').val(data.color);
						$('[name="size_edit"]').val(data.size);
						$('[name="digit_edit"]').val(data.four_digit);
						$('[name="unit_edit"]').val(data.unit);
						$('[name="quantity_edit"]').val(data.quantity);
						$('[name="production_edit"]').val(data.production);
						$('[name="model_edit"]').val(data.model);
						$('[name="code_edit"]').val(data.model_code);
						$('[name="item_edit"]').val(data.item);
						$('[name="date_edit"]').val(data.date_time);
						$('[name="scan_edit"]').val(data.scan_no);
						$('[name="username_edit"]').val(data.username);
						$('[name="user"]').val(data.username);
						$('[name="description_edit"]').val(data.description);
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
			{"data": "username"},
			{"data": "position"},
			{"data": "description"},
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
		//end setup datatables user
		
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
						$('[name="position_edit"]').val(data.position);
						$('[name="description_edit"]').val(data.description);
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
			order: [[0, 'desc']],
			rowCallback: function(row, data, iDisplayIndex) {
				var info=this.fnPagingInfo();
				var page=info.iPage;
				var length=info.iLength;
				$('td:eq(0)', row).html();
			}
		});
		//end setup datatables transaction
		
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
		//end setup datatables delivery
		
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
		//setup datatables model
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
			ajax: {"url": "<?php echo base_url().'controller_monitoring/get_guest_json_model'?>", "type": "POST"},
			columns: [
			{"data": "model_code"},
			{"data": "model"},
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
		//end setup datatables model
		
		//get edit model
		$('#mytable7').on('click','.edit_record',function(){
			var model_code=$(this).data('model_code');
			$.ajax({
				type : "GET",
				url  : "<?php echo base_url('controller_monitoring/get_model')?>",
				dataType : "JSON",
				data : {model_code:model_code},
				success: function(data){
					$.each(data,function(model_code, model){
						$('#ModalUpdate').modal('show');
						$('[name="model_code_edit"]').val(data.model_code);
						$('[name="model_edit"]').val(data.model);
					});
				}
			});
			return false;
		});
		//end get edit model
		
		//get delete model
		$('#mytable7').on('click','.delete_record',function(){
			var model_code=$(this).data('model_code');
			$('#ModalDelete').modal('show');
			$('[name="model_code"]').val(model_code);
		});
		//end get delete model
	});
</script>

<script>
	$(document).ready(function(){
		//setup datatables size
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

		var table=$("#mytable8").dataTable({
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
			ajax: {"url": "<?php echo base_url().'controller_monitoring/get_guest_json_size'?>", "type": "POST"},
			columns: [
			{"data": "size_code"},
			{"data": "size"},
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
		//end setup datatables size
		
		//get edit size
		$('#mytable8').on('click','.edit_record',function(){
			var size_code=$(this).data('size_code');
			$.ajax({
				type : "GET",
				url  : "<?php echo base_url('controller_monitoring/get_size')?>",
				dataType : "JSON",
				data : {size_code:size_code},
				success: function(data){
					$.each(data,function(size_code, size){
						$('#ModalUpdate').modal('show');
						$('[name="size_code_edit"]').val(data.size_code);
						$('[name="size_edit"]').val(data.size);
					});
				}
			});
			return false;
		});
		//end get edit size
		
		//get delete size
		$('#mytable8').on('click','.delete_record',function(){
			var size_code=$(this).data('size_code');
			$('#ModalDelete').modal('show');
			$('[name="size_code"]').val(size_code);
		});
		//end get delete size
	});
</script>

<script>
	$(document).ready(function(){
		//setup datatables production
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

		var table=$("#mytable9").dataTable({
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
			ajax: {"url": "<?php echo base_url().'controller_monitoring/get_guest_json_production'?>", "type": "POST"},
			columns: [
			{"data": "production_code"},
			{"data": "production"},
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
		//end setup datatables production
		
		//get edit production
		$('#mytable9').on('click','.edit_record',function(){
			var production_code=$(this).data('production_code');
			$.ajax({
				type : "GET",
				url  : "<?php echo base_url('controller_monitoring/get_production')?>",
				dataType : "JSON",
				data : {production_code:production_code},
				success: function(data){
					$.each(data,function(production_code, production){
						$('#ModalUpdate').modal('show');
						$('[name="production_code_edit"]').val(data.production_code);
						$('[name="production_edit"]').val(data.production);
					});
				}
			});
			return false;
		});
		//end get edit production
		
		//get delete production
		$('#mytable9').on('click','.delete_record',function(){
			var production_code=$(this).data('production_code');
			$('#ModalDelete').modal('show');
			$('[name="production_code"]').val(production_code);
		});
		//end get delete production
	});
</script>

<script>
	$(document).ready(function(){
		//setup datatables record
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

		var table=$("#mytable10").dataTable({
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
			{"data": "date_time"},
			{"data": "original_barcode"},
			{"data": "brand"},
			{"data": "model"},
			{"data": "color"},
			{"data": "size"},
			{"data": "quantity"},
			{"data": "username"},
			{"data": "description"},
			{"data": "scan_no"},
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
		//end setup datatables record
		
		//get edit record
		$('#mytable10').on('click','.edit_record',function(){
			var date=$(this).data('date');
			var scan=$(this).data('scan');
			var user=$(this).data('user');
			$.ajax({
				type : "GET",
				url  : "<?php echo base_url('controller_monitoring/get_record')?>",
				dataType : "JSON",
				data : {date:date, scan:scan, user:user},
				success: function(data){
					$.each(data,function(original_barcode, brand, color, size, four_digit, unit, quantity, production, model, model_code, item, date_time, scan_no, username, description){
						$('#ModalUpdate').modal('show');
						$('[name="barcode_edit"]').val(data.original_barcode);
						$('[name="brand_edit"]').val(data.brand);
						$('[name="color_edit"]').val(data.color);
						$('[name="size_edit"]').val(data.size);
						$('[name="digit_edit"]').val(data.four_digit);
						$('[name="unit_edit"]').val(data.unit);
						$('[name="quantity_edit"]').val(data.quantity);
						$('[name="production_edit"]').val(data.production);
						$('[name="model_edit"]').val(data.model);
						$('[name="code_edit"]').val(data.model_code);
						$('[name="item_edit"]').val(data.item);
						$('[name="date_edit"]').val(data.date_time);
						$('[name="scan_edit"]').val(data.scan_no);
						$('[name="username_edit"]').val(data.username);
						$('[name="user"]').val(data.username);
						$('[name="description_edit"]').val(data.description);
					});
				}
			});
			return false;
		});
		//end get edit record
		
		//get delete record
		$('#mytable10').on('click','.delete_record',function(){
			var date=$(this).data('date');
			var scan=$(this).data('scan');
			var user=$(this).data('user');
			$('#ModalDelete').modal('show');
			$('[name="date"]').val(date);
			$('[name="scan"]').val(scan);
			$('[name="user"]').val(user);
		});
		//end get delete record
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#barcode').on('input',function(){  
			var barcode=$(this).val();
			$.ajax({
				type : "POST",
				url  : "<?php echo base_url('controller_scan/post_barcode')?>",
				dataType : "JSON",
				data : {barcode: barcode},
				cache:false,
				success: function(data){
					$.each(data,function(original_barcode, brand, color, size, four_digit, unit, quantity, production, model, model_code, item){
						$('[name="brand_edit"]').val(data.brand);
						$('[name="color_edit"]').val(data.color);
						$('[name="size_edit"]').val(data.size);
						$('[name="digit_edit"]').val(data.four_digit);
						$('[name="unit_edit"]').val(data.unit);
						$('[name="quantity_edit"]').val(data.quantity);
						$('[name="production_edit"]').val(data.production);
						$('[name="model_edit"]').val(data.model);
						$('[name="code_edit"]').val(data.model_code);
						$('[name="item_edit"]').val(data.item);
					});	
				}
			});
			return false;
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		//edit description
		$('[name="username_edit"]').change(function(){ 
            var username=$(this).val();
			$.ajax({
				type : "POST",
				url  : "<?php echo base_url('controller_scan/post_username')?>",
				dataType : "JSON",
				data : {username: username},
				cache:false,
				success: function(data){
					$.each(data,function(username, position, description){
						$('[name="description_edit"]').val(data.description);
					});	
				}
			});
			return false;
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		//add model code
		$('[name="model"]').change(function(){ 
            var model=$(this).val();
			$.ajax({
				type : "POST",
				url  : "<?php echo base_url('controller_monitoring/post_model')?>",
				dataType : "JSON",
				data : {model: model},
				cache:false,
				success: function(data){
					$.each(data,function(model_code, model){
						$('[name="code"]').val(data.model_code);
					});	
				}
			});
			return false;
		});
	});
	
	$(document).ready(function(){
		//edit model code
		$('[name="model_edit"]').change(function(){ 
            var model=$(this).val();
			$.ajax({
				type : "POST",
				url  : "<?php echo base_url('controller_monitoring/post_model')?>",
				dataType : "JSON",
				data : {model: model},
				cache:false,
				success: function(data){
					$.each(data,function(model_code, model){
						$('[name="code_edit"]').val(data.model_code);
					});	
				}
			});
			return false;
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		//add size code
		$('[name="size"]').change(function(){ 
            var size=$(this).val();
			$.ajax({
				type : "POST",
				url  : "<?php echo base_url('controller_monitoring/post_size')?>",
				dataType : "JSON",
				data : {size: size},
				cache:false,
				success: function(data){
					$.each(data,function(size_code, size){
						$('[name="digit"]').val(data.size_code);
					});	
				}
			});
			return false;
		});
	});
	
	$(document).ready(function(){
		//edit size code
		$('[name="size_edit"]').change(function(){ 
            var size=$(this).val();
			$.ajax({
				type : "POST",
				url  : "<?php echo base_url('controller_monitoring/post_size')?>",
				dataType : "JSON",
				data : {size: size},
				cache:false,
				success: function(data){
					$.each(data,function(size_code, size){
						$('[name="digit_edit"]').val(data.size_code);
					});	
				}
			});
			return false;
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		//add description
		$('[name="position"]').change(function(){ 
            var id=$(this).val();
            $.ajax({
                url : "<?php echo site_url('controller_user/get_description');?>",
                method : "POST",
                data : {id: id},
                async : true,
                dataType : 'json',
                success: function(data){         
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].description_name+'>'+data[i].description_name+'</option>';
                    }
                    $('[name="description"]').html(html);
                }
            });
            return false;
        });             
	});
	
	$(document).ready(function(){
		//edit description
		$('[name="position_edit"]').change(function(){ 
            var id=$(this).val();
            $.ajax({
                url : "<?php echo site_url('controller_user/get_description');?>",
                method : "POST",
                data : {id: id},
                async : true,
                dataType : 'json',
                success: function(data){                       
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].description_name+'>'+data[i].description_name+'</option>';
                    }
                    $('[name="description_edit"]').html(html);
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