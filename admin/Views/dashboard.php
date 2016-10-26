<?php
if (! isset ( $_SESSION ['ses_admin_user'] )) {
	header ( 'Location:index.php?page=signin' );
	die ();
}
$edit_page = 'index.php?page=dashboard';
$view_page = 'index.php?page=dashboard';
$list_page = 'index.php?page=dashboard';
$table_name = 'winners';
$create_sql = "
CREATE TABLE IF NOT EXISTS `winners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `position` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
    ";
$db->run_sql ( $create_sql );
 
//die;
if(isset($_POST['update'])){
	$_POST['date'] = dateFormat($_POST['date'],'Y-m-d');
	$db->update($table_name,$_POST,' id= '.$_GET['id']);
	$_SESSION['DATA_UPDATED'] = "Winner Updated Successfully";
	 header("Location:".SITE_PATH.$edit_page);die;
}
else if(isset($_POST['add'])){
	$_POST['date'] = dateFormat($_POST['date'],'Y-m-d');
	$db->insert($table_name,$_POST);
	$_SESSION['DATA_CREATED'] = "Winner Created Successfully";
	 header("Location:".SITE_PATH.$edit_page);die;;
}
else if(isset($_GET['delete']) && $_GET['delete'] != ''){
	$db->delete($table_name,' id= '.$_GET['delete']);
	$_SESSION['DATA_DELETED'] = "Winner Deleted Successfully";
	 header("Location:".SITE_PATH.$edit_page);die;
}
$field_array = array (
 		
		'name' => 'Name',
		'date' => 'Date',
		'position' => 'Position' 
);

$order_clause = ' order by position asc, id desc';
$getWinners = $db->get_array ( "select * from `" . $table_name . "` where 1 " . $order_clause );

?>
<!-- Main content -->
<section class="content">


	<div class="box">
		<div class="box-body table-responsive trans_title">


			<span><?php echo 'Winners' ; ?></span>

			<!--  <small>Listing User Details</small>-->
			</h1>
		</div>
	</div>
<?php
 echo alert ( 'DATA_CREATED', 'alert-success' );
 echo alert ( 'DATA_UPDATED', 'alert-success' );
 
echo alert ( 'DATA_DELETED', 'alert-danger' );
?>

    <div class="box">
		<div class="box-body table-responsive">
			<h1>Winners</h1>
 				<table class="tab-details">
					<colgroup>
						<col width="20%" />
						<col width="20%" />
						<col width="20%" />
						<col width="20%" />

					</colgroup>
					<tr>
<?php
foreach ( $field_array as $key_order => $value ) {
	?>
                            <th><?php echo $value; ?></a></th>
                        <?php } ?>
                        <th>Actions</th>
					</tr>
<?php
if (count ( $getWinners ) > 0) {
	foreach ( $getWinners as $userKey => $uservalue ) {
		?> 				<tr>
						<td colspan="5">
							<form method="POST"
								action="<?php echo SITE_PATH . $edit_page; ?>&id=<?php echo $uservalue->id; ?>">
								<table width="100%">
 						<col width="20%" />
						<col width="20%" />
						<col width="20%" />
						<col width="20%" />
									<tr>
 										<td><input type="text" value="<?php echo $uservalue->name; ?>"
											name="name" /></td>
										<td><input type="text" value="<?php echo $uservalue->date; ?>"
											name="date" class="datepicker" /></td>
										<td><input type="text"
											value="<?php echo $uservalue->position; ?>" name="position" /></td>
										<td><button name="update" class="edit btn btn-primary btn-success">
												<i class="fa fa-edit"></i>Update
											</button> &nbsp;
											<a class=" btn btn-primary btn-danger "
											href="<?php echo SITE_PATH . $edit_page; ?>&delete=<?php echo $uservalue->id; ?>">Delete</a></td>

										</td>
									</tr>
								</table>
							</form>
						</td>
					</tr>
                         
    <?php } ?>
                    <?php }   ?>
                    	<tr>
						<td colspan="5">
							<form method="POST"
								action="<?php echo SITE_PATH . $edit_page; ?>">
								<table width="100%" cellpadding="0" cellspacing="0" border="0" class="tab-details-inner" >
 						<col width="20%" />
						<col width="20%" />
						<col width="20%" />
						<col width="20%" />
							 
									<tr>
										<td><input type="text" value="" name="name" /></td>
										<td><input type="text" value="" name="date" class="datepicker" /></td>
										<td><input type="text" value="" name="position" /></td>
										<td><button name="add" class="edit btn btn-primary btn-success">
												<i class="fa fa-edit"></i>Add
											</button></td>

										</td>
									</tr>
								</table>
							</form>
						</td>
					</tr>

				</table>
 		</div>
		<!-- /.box-body -->
	</div>
	<!-- /.box -->
	<!-- /.col -->
	<!-- /.row -->

</section>
<!-- /.content -->
</aside>
<!-- /.right-side -->
</div>
<!-- ./wrapper -->
