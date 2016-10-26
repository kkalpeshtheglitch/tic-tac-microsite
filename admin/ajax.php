<?php
ob_start();
ini_set("memory_limit", "520M");
if (!session_id())
    session_start();
require_once('Includes/CommonIncludes.php');
 
if ((isset($_GET['action'])) && ($_GET['action'] != '')) {

 

    if ($_GET['action'] == 'image_upload') {

        unset($_SESSION['ses_file_invalid']);
        if (isset($_POST['fk_pagecreation_id']) && $_POST['fk_pagecreation_id'] != '') {
             
            $table_name = "gallery";
            $file_key = 'event_image';
            $thumb_array = array('170', '84');
            $upload_folder = "Event";
            $temp = explode(".", $_FILES[$file_key]["name"]);
            $extension = end($temp);
             $_POST['image'] = $extension;
            
            $db->insert($table_name, $_POST);
            $id = $db->get_last_insert_id();

            uploadImage($_FILES, $id, $table_name, $upload_folder, $allowedExts, $thumb_array, $file_key, 1);
            $thumb_add_array = array('280', '350');
            $destination = UPLOAD_PATH;
            $image_name = $id . '.' . $extension;
            resize_crop_image($thumb_add_array[0], $thumb_add_array[1], $destination . $upload_folder . '/' . $image_name, $destination . $upload_folder . $image_name, $quality = 99);
            $big_array = array('960', '640');
           // resize_crop_image($big_array[0], $big_array[1], $destination . $upload_folder . '/' . $image_name, $destination . $upload_folder . '/Big/' . $image_name, $quality = 99);
            if (isset($_SESSION['ses_file_invalid']) && $_SESSION['ses_file_invalid'] == 1) {
                $db->delete($table_name, ' id=' . $id);
                ?>
                <script>
                    alert('Size is too big or Invalid');
                </script>
                <?php
            } else {
                $message['id'] = $id;
                $message['ext'] = $id . '.' . $extension;
                
                ?>
                <script>
                    window.parent.setUploadedImage('<?php echo json_encode($message); ?>');
                </script>
                <?php
            }
        }
        die;
    }
}
die;
