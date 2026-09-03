<title>PT HANDAL SUKSES KARYA</title>
	<?php $array_hari=array(1=>'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');$hari=$array_hari[date('N')];?>
	<?php $hari1=date('Y-m-d') ?>
	<?php $jam=date('G:i:s') ?>
<!-- Main content -->
<section class="content">
	<div class="box">
		<div class="box-header">
			<i class="fa fa-user"></i>
			<h3 class="box-title">User</h3>
		</div>
		<div class="box-body">
			<div class="header">
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalAdd">
                    <i class="fa fa-plus"> Add User</i>
                </button>
			</div>
			<br/>
			<div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div>
			<div class="body table-responsive">
				<div class="table-wrapper-scroll-y">                          
					<table class="table table-bordered table-fixed" id="mytable4">
						<thead>
							<tr class="bg-light-blue">
								<th>ID USER</th>
								<th>USERNAME</th>
								<th>POSITION</th>
								<th>DESCRIPTION</th>
								<th>PASSWORD</th>
								<th width="140">ACTION</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
				
			<!-- modal add user -->
			<form id="add-row-form" action="<?php echo base_url().'controller_user/save_user'?>" method="post">
				<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h2 class="modal-title" align="center" id="myModalLabel">Add User</h2>
							</div>
							<div class="modal-body">
								<div class="col-md-6">
									<div class="form-group">
										<label for="username">Username:</label>
										<input type="text" name="username" class="form-control" placeholder="Username" maxlength="15" onkeyup="this.value=this.value.toUpperCase()" required>
									</div>
									<div class="form-group">
										<label for="position">Position:</label>
										<select class="form-control" name="position" required>
											<option value="-">-</option>
											<?php foreach($position as $row):?>
											<option value="<?php echo $row->position_id;?>"><?php echo $row->position_name;?></option>
											<?php endforeach;?>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="description">Description:</label>
										<select class="form-control" name="description" required>
											<option value="-">-</option>
										</select>
									</div>									
									<div class="form-group">
										<label for="password">Password:</label>
										<input type="password" name="password" class="form-control" placeholder="Password" maxlength="10" onkeyup="this.value=this.value.toLowerCase()" required>
									</div>								
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-warning" data-dismiss="modal">
                        			<i class="fa fa-remove"> Close</i>
                    			</button>
                    			<button type="submit" class="btn btn-success" id="add-row">
                       				<i class="fa fa-plus"> Add</i>
								</button>
							</div>
						</div>
					</div>
				</div>
			</form>
				
			<!-- modal edit user -->
			<form id="add-row-form" action="<?php echo base_url().'controller_user/edit_user'?>" method="post">
				<div class="modal fade" id="ModalUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h2 class="modal-title" align="center" id="myModalLabel">Edit User</h2>
							</div>
							<div class="modal-body">
								<div class="col-md-6">
									<div class="form-group">
										<label for="username">Username:</label>
										<input type="text" name="username_edit" class="form-control" placeholder="Username" maxlength="15" onkeyup="this.value=this.value.toUpperCase()" readonly required>
									</div>
									<div class="form-group">
										<label for="position">Position:</label>
										<select class="form-control" name="position_edit" id="position_edit" required>
											<option value="-">-</option>
											<?php foreach($position as $row):?>
											<option value="<?php echo $row->position_id;?>"><?php echo $row->position_name;?></option>
											<?php endforeach;?>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="description">Description:</label>
										<select class="form-control" name="description_edit" id="description_edit" required>
											<option value="-">-</option>
										</select>
									</div>
									<div class="form-group">
										<label for="password">Password:</label>
										<input type="password" name="password_edit" class="form-control" placeholder="Password" maxlength="10" onkeyup="this.value=this.value.toLowerCase()" required>
									</div>
									<div class="form-group">
										<input type="hidden" name="id_user_edit" class="form-control" placeholder="ID User" maxlength="7" onkeyup="this.value=this.value.toUpperCase()" required>
									</div>									
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-warning" data-dismiss="modal">
                        			<i class="fa fa-remove"> Close</i>
                    			</button>
                   				<button type="submit" class="btn btn-info" id="add-row">
                       				<i class="fa fa-pencil"> Edit</i>
                   				</button>
							</div>
						</div>
					</div>
				</div>
			</form>
				
			<!-- modal delete user -->
			<form id="add-row-form" action="<?php echo base_url().'controller_user/delete_user'?>" method="post">
				<div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h2 class="modal-title" align="center" id="myModalLabel">Delete User</h2>
							</div>
							<div class="modal-body">
								<input type="hidden" name="id" class="form-control" placeholder="Original Barcode" required>
								<strong>Anda yakin mau menghapus user ini?</strong>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-warning" data-dismiss="modal">
                        			<i class="fa fa-remove"> Close</i>
                    			</button>
                   				<button type="submit" class="btn btn-danger" id="add-row">
                       				<i class="fa fa-trash-o"> Delete</i>
                   				</button>
							</div>
						</div>
					</div>
				</div>
			</form>	
		</div>
	</div>
</section>