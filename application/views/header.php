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
<script type="text/javascript" src="<?php echo base_url();?>js/tiny_mce/tiny_mce.js"></script>

<script>
    tinyMCE.init({
            theme : "advanced",
            skin : "o2k7",
            skin_variant : "silver",
            mode : "textareas",
            plugins : "preview,emotions,paste,print",
            //plugins : "imagemanager,filemanager,insertdatetime,preview,emotions,visualchars,nonbreaking",
            theme_advanced_buttons1_add: 'separator,copy,paste,print,preview,separator,forecolor,backcolor,emotions',
            //theme_advanced_buttons1_add: 'insertimage,insertfile',
            //theme_advanced_buttons2_add: 'separator,forecolor,backcolor,emotions',
            //theme_advanced_buttons3_add: 'emotions',
            theme_advanced_disable: "|,styleselect,formatselect,removeformat,hr,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,outdent,indent,cleanup,help,visualaid,sub,sup",
            theme_advanced_font_sizes: "13px,15px",
            theme_advanced_toolbar_location: "top",
            theme_advanced_statusbar_location: "bottom",
            theme_advanced_path: false,
            theme_advanced_text_colors: "1c609f",
            plugin_insertdate_dateFormat : "%Y-%m-%d",
            plugin_insertdate_timeFormat : "%H:%M:%S",
            theme_advanced_toolbar_align : "left",
            theme_advanced_resize_horizontal : false,
            theme_advanced_resizing : false,
            apply_source_formatting : true,
            spellchecker_languages : "+English=en",
            extended_valid_elements :"img[src|border=0|alt|title|width|height|align|name],"
            +"a[href|target|name|title],"
            +"p,"
            +"iframe[width|height|src|frameborder|allowfullscreen],",
            invalid_elements: "table,tr,td,tbody"
        });
</script>

</head>

<body>
<div id="top_nav">
    <ul class="nav">
            <li class="home"><a style="padding: 0; height: 40px; width: 40px;" href="/" title="Home Page"><span class="icon_home"></span></a></li>
        <?php if(isset($username) && $username != '') { ;?>
            <li><a href="<?php echo base_url();?>home/logout">Logout</a></li>
            <!--<li class="separator">|</li>
            <li><a href="<?php //echo base_url();?>add_virus_definition">Add Virus</a></li>-->
            <li class="separator">|</li>
            <?php if($is_admin) { ?>
            <li><a href="<?php echo base_url();?>admin">Admin</a></li>
            <li class="separator">|</li>
            
            <!--<li><a href="<?php //echo base_url();?>threat">Re-Map Virus</a></li>
            <li class="separator">|</li>-->
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
                <?php echo form_open('../home/search_by_title', array('id' => 'search_form')); ?>
                    <input type="submit" name="submit" id="search_btn" value="" title="Search" />
                
                    <input type="text" id="search_box" name="search_box" placeholder="Search Android Threat Database" />
                <?php echo form_close();?>
            </div>
        </div>
    </div>