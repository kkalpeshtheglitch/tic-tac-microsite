<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin</title>
        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo SITE_PATH; ?>css/bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo SITE_PATH; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo SITE_PATH; ?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo SITE_PATH; ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_PATH; ?>css/component.css" />
        
           <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<!--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>-->
        <script src="<?php echo SITE_PATH; ?>js/jquery-ui-1.10.3.min.js"></script>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>

    <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
    <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
    <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
    <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
    <!--[if (gt IE 9)|!(IE)]><!--> 
    <body class="skin-blue">
        <!--    	
                <div class="loader-bg">
                        <img src="<?php echo SITE_PATH; ?>img/loader.GIF">
                </div>
        -->
        <!-- header logo: style can be found in header.less -->
        <?php if (isset($_SESSION['ses_admin_user'])) { ?>
            <header class="header <?php if (isset($_GET['page']) && ($_GET['page'] == 'signin')) echo 'logo-sign'; ?> ">

                <?php if (isset($_GET['page']) && ($_GET['page'] != 'signin')) { ?>
                    <!-- Header Navbar: style can be found in header.less -->
                    <nav class="navbar navbar-static-top" role="navigation">
                        <a href="<?php echo SITE_PATH.FIRST_PAGE; ?>" class="logo"><!-- Add the class icon to your logo image or logo icon to add the margining --></a>
                        <!-- Sidebar toggle button-->


                        <div class="navbar-right">
                            <div class="pull-left">

                                <?php
                                /*$current_url = getCurrentUrl();
                                $current_url = removeqsvar($current_url, 'set_lang');
                                foreach ($lang as $key => $value) {
                                    $new_url = addqsvar($current_url, 'set_lang') . $key;
                                    $class = "btn-lang";
                                    if ($cur_lang == $key) {
                                        $new_url = 'javascript:void(0);';
                                        $class = "btn-warning";
                                    }
                                    ?>
                                    &nbsp;&nbsp; <a class="btn <?php echo $class; ?> btn-flat" href="<?php echo $new_url; ?>"><?php echo $key; ?></a>
                                <?php }*/
                                ?>

                                &nbsp;&nbsp; <a href="<?php echo SITE_PATH . 'index.php?page=logout'; ?>" class="btn btn-default btn-flat">LOGOUT</a>
                            </div>
                        </div>

                    </nav>
                <?php } ?>
            </header>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side strech">
                <!-- Content Header (Page header) -->
                <?php require 'templates/sidenav.php'; ?>

            <?php } ?>