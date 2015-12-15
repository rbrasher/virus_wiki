<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AndroidThreats.org</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<link rel="shortcut icon" href="images/favicon.ico" />
<link href="<?php echo base_url();?>css/extra.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>css/styles.css" rel="stylesheet" type="text/css" />

<script src="<?php echo base_url();?>js/jquery-1.7.2.min.js"></script>

</head>

<body>
<div id="top_nav">
    <ul>
            <li class="home"><a style="padding: 0; height: 40px; width: 40px;" href="/" title="Home Page"><span class="icon_home"></span></a></li>
        <?php if(isset($username) && $username != '') { ;?>
            <li><a href="<?php echo base_url();?>home/logout">Logout</a></li>
            <li class="separator">|</li>
            <?php if($is_admin) { ?>
            <li><a href="<?php echo base_url();?>">Home</a></li>
            <li class="separator">|</li>
            
            <!--
            <li><a href="<?php //echo base_url();?>threat">Re-Map Virus</a></li>
            <li class="separator">|</li>
            -->
            <?php } ?>
            <li style="padding: 0 10px;">Welcome, <?php echo ucwords($username);?></li>
        <?php } else { ?>
            <li><a href="<?php echo base_url();?>login">Login</a></li>
            <li class="separator">|</li>
            <li><a href="<?php echo base_url();?>login/signup">Create an Account</a></li>
        <?php } ?>
    </ul>
</div>
<div class="wrapper">
    <div id="header">
        
        <div class="header_left">
            <div id="header_icon" onclick="window.location='/';"></div>
        </div>
        <div class="header_right">
            <div id="search">
                <?php echo form_open('home/search_by_title', array('id' => 'search_form')); ?>
                    <input type="submit" name="submit" id="search_btn" value="" title="Search" />
                
                    <input type="text" id="search_box" name="search_box" placeholder="Search Android Virus Database" />
                <?php echo form_close();?>
            </div>
        </div>
    </div>