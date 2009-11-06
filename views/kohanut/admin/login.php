<?php echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title><?php echo (isset($title) ? "Admin - " . $title : "Admin"); ?></title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    
    <link rel="stylesheet" type="text/css" href="/kohanutres/reset.css" />
	<link rel="stylesheet" type="text/css" href="/kohanutres/kohanut.css" />
	
	<script type="text/javascript" src="/kohanutres/jquery/jquery-1.3.2.min.js" ></script>
	<script type="text/javascript" src="/kohanutres/jquery/jquery.treeview.js"></script>
	<script type="text/javascript" src="/kohanutres/jquery/jquery.cookie.js"></script>
    
    
    <style type="text/css">

        .logincontainer {
            width:300px;
            margin:120px auto 0;
            border:1px solid #888;
            -moz-border-radius: 4px; -webkit-border-radius: 4px;
            background:white;
        }
        
        .logincontainer .top {
            background:#005014 url('/kohanutres/img/header-bg.gif') top left repeat-x scroll;
            text-align:center;
        }
        
        .logincontainer .content {
            padding:10px;
        }
        
        .standardform p {
            margin-bottom:3px;
            float:right;
            clear:both;
            width:100%;
        }
        
        .standardform label {
            width:80px;
            float:left;
        }
        .standardform input {
            float:left;
            width:170px;
        }
        
        .standardform .submit {
            clear:left;
            float:left;
            margin:auto;
            position:relative;
            float:none;
            display:block;
            left:0;
        }
        
        .errorInput {
            border:1px solid red;
            background:#FFCCCC;
        }
    </style>
</head>
<body>

    <div class="logincontainer">
        
        <div class="top">
            <a href="http://kohanut.com"><img id="headerlogo" alt="Powered by Kohanut" src="/kohanutres/img/logo.png" /></a>
        </div>
        
        <div class="content">
            
			
<?php echo form::open(NULL, array('id' => 'login')) ?>
  
  <h1><?php echo 'Login' ?></h1>
  
  <?php include Kohana::find_file('views', 'kohanut/admin/errors') ?>
  
  <ol class="loginform">
   <li><label><span><?php echo 'Username:' ?></span> <?php echo form::input('username', $user->username) ?></label></li>
   <li><label><span><?php echo 'Password:' ?></span> <?php echo form::password('password') ?></label></li>
  </ol>
  
  <?php echo form::button(NULL, 'Login', array('type' => 'submit')) ?>
  
  <?php echo form::close() ?>
			
			
            <div class="clear"></div>
        </div>
        
    </div>
    
</body>
</html>