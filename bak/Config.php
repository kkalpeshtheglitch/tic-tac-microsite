<?php

/**
 *
 * DB class
 *
 * Version 0.1
 */




$ARRAY_INDEX = 'production'; 
if ($_SERVER['HTTP_HOST'] == 'bbltest.muvacon.com') {
    $site_path = "";
    $ARRAY_INDEX = 'production';
}
else{
     $site_path = "http://tictacconsumerpromo.in/"; // SITE PATH HERE  
    $ARRAY_INDEX = 'dev';
}

 


//Server ------- PLEASE CHANGE THE CONFIG HERE
$database['production']['host'] = 'localhost';
$database['production']['database'] = 'abc';
$database['production']['user'] = 'muvacon';
$database['production']['pass'] = 'admin@123';
$database['production']['site_path'] = $site_path.'admin/';
$database['production']['user_site_path'] = $site_path;
$site_path = $site_path.'/admin/';



// Local
$database['dev']['host'] = 'localhost';
$database['dev']['database'] = 'tictacco_microsite';
$database['dev']['user'] = 'tictacco_microsi';
$database['dev']['pass'] = 'Cs@Xu%)TJv~;';
$database['dev']['user_site_path'] = $site_path;
$database['dev']['site_path'] = $site_path;
 