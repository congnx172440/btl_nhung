<?php
define ('SITE_ROOT', realpath(dirname(__FILE__)));
$target_dir = "upload";
$datum =mktime(date('H')+6, date('i'), date('s'), date('m'), date('d'), date('y'));
$target_file = date('H_i_s_d_m_Y_', $datum).basename($_FILES["imageFile"]["name"]);
$uploadOk = 1;
$img_str= strtolower(pathinfo($target_file,PATHINFO_FILENAME));
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["imageFile"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  }
  else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["imageFile"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
}
else {
  

  if (move_uploaded_file($_FILES["imageFile"]["tmp_name"],SITE_ROOT."\\"."$target_file")) 
  {
    echo "The file ". basename( $_FILES["imageFile"]["name"]). " has been uploaded.";
    $options  = array('http' => array('user_agent' => 'custom user agent string'));
    $context  = stream_context_create($options);
    $response = file_get_contents("http://127.0.0.1:3000/"."$img_str", false, $context);
    if($response=='OK')
    {
      $response = file_get_contents("http://192.168.0.101:81/okmask/".basename( $_FILES["imageFile"]["name"],'jpg'), false, $context);
    }
    else{
      $response = file_get_contents("http://192.168.0.101:81/nokmask/".basename( $_FILES["imageFile"]["name"],'jpg'), false, $context);
    }
  }
  else 
  {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>
