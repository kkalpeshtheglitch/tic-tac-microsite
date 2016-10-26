<?php
if (isset($_GET['page']) && $_GET['page'] != '' && $_GET['page'] != '404') {
    $qpage = trim($_GET['page'], '/');
    $qpage = rtrim($_GET['page'], '.php');
} else {
    $qpage = 'import';
}
$dClass = $uClass = $iClass = $qClass = $iClass = '';
 
$page_name = 'Dashboard';
if ($qpage == 'dashboard') {
    $page_name = 'Dashboard';
    $dClass = 'active';
}  
?> 
<section class="content-header">
    <ul class="nav-main nav">
 
        <li><a class="<?php echo $dClass; ?>" href="<?php echo SITE_PATH; ?>dashboard">
                <i class="fa fa-bar-chart-o"></i> <span>Dashboard</span>

            </a> 

    </ul>

    <ol class="breadcrumb">
        <li><a href="<?php echo HOME_SITE_LINK; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $page_name; ?></li> 
    </ol>
</section>