<?php
if(isset($_SESSION['ses_admin_user'])){
	header('Location:'.FIRST_PAGE); die();
}
$messages = array();
 
if(isset($_POST['signin'])){
     
    
    $error = 0;
    if(isset($_POST['username']) && $_POST['username'] == ''){
        $messages[] = 'Username is required';
        $error = 1;
    }
    if(isset($_POST['password']) && $_POST['password'] == '') {
        $messages[] = 'Password is required';
        $error = 1;
    }
   
    if($error == 0 ) {
         $sql           = "select * from admin where username='".$_POST['username']."' and password= '".($_POST['password'])."'";
         $fetch_array   = $db->get_item($sql);
         if($fetch_array){
             $_SESSION['ses_admin_user']        = $fetch_array->id;
             $_SESSION['ses_admin_name']        = $fetch_array->username;
             $_SESSION['ses_admin_username']    = $fetch_array->name;
              if($fetch_array->status == 1) {
                 $_SESSION['ses_admin_super_user'] = 1;
             }
              header('Location:'.FIRST_PAGE);die;
         }
         else{
             $messages[] = 'Invalid Username / Password';
         }
    }
}
?>

    <div class="row-fluid">
       <div class="dialog">
           <?php if(count($messages) > 0){ ?>
           <div class="alert alert-error">
               <button type="button" class="close" data-dismiss="alert">x</button>
               <?php foreach($messages as $message){ ?>
               <strong><?php echo $message; ?></strong><br>
               <?php }  ?>
           </div>
           <?php } ?>
           <div class="block-sign">
               <h2 class="block-heading"><img src="<?php echo SITE_PATH; ?>img/movaconlogo.png" alt=""/></h2>
               <div class="block-body">
                   <form method="POST" action="" name="signinform" id="signinform">
                       <label>Username</label>
                       <input type="text" name="username" id="username" class="form-control">
                       <label>Password</label>
                       <input type="password"  name="password" id="password"  class="form-control">
                        <input type="submit" class="btn btn-primary pull-right" name="signin" value="Sign in">
                        <div class="clearfix"></div>
                   </form>
               </div>
           </div>
	   
       </div>
   </div>
</div>
