<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $profile->companyName;?>">
    <meta name="author" content="<?php echo $profile->companyName;?>">
    <link rel="icon" type="image/png" href="<?php echo base_url('asset/img/uploads/banner/') ?><?php if(!empty($icontitle->image)){echo $icontitle->image;}?>"/>    
    <title><?php echo $profile->companyName;?></title>
    <link href="<?php echo base_url('asset/') ?>vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('asset/') ?>vendors/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="<?php echo base_url('asset/') ?>dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="<?php echo base_url('asset/') ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="alert alert-default">
                    <?php if ($this->session->flashdata('MSG')) { ?>
                    <?= $this->session->flashdata('MSG') ?>
                    <?php } ?>
                </div>
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center"><?php echo $profile->companyName;?> Dashboard<br> Please Sign In
                        </h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="<?php echo base_url('d/User/do_login')?>" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus required="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="" required="">
                                </div>
                                <button class="btn btn-lg btn-success btn-block" type="submit">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url('asset/') ?>vendors/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url('asset/') ?>vendors/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('asset/') ?>vendors/metisMenu/metisMenu.min.js"></script>
    <script src="<?php echo base_url('asset/') ?>/dist/js/sb-admin-2.js"></script>
</body>
</html>
