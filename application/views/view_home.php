<body class="hold-transition login-page">
    <?php $flash_pesan=$this->session->flashdata('msg')?>
    <?php if (! empty($flash_pesan)) { ?>
    <div class="alert-info">
        <?php echo $flash_pesan;} ?>
    </div>
    <div class="login-box">
        <div class="login-logo">
            <b>HSK</b>PRO
        </div>
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your work</p>
            <form action="<?php echo base_url('controller_login/cek_login');?>" method="post">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="username" placeholder="Username" onkeyup="this.value=this.value.toUpperCase()" autofocus required>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" placeholder="Password" onkeyup="this.value=this.value.toUpperCase()" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-4 pull-right">
                    <button type="submit" class="btn bg-maroon btn-block btn-flat"><i class="fa fa-check"></i> Sign In</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body> 