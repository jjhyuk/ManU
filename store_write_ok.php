<?php

$db = mysql_connect( localhost , 'root' , 'sql!' );
if( !$db ){
    die('MySQL connect ERROR : ' . mysql_error());
}

$ret = mysql_select_db( 'userProfile', $db);
if (!$ret) {
    die('MySQL select ERROR : '. mysql_error());
    }

session_start();

$p_head = $_POST[p_head];
$p_body = $_POST[p_body];
$p_price = $_POST[p_price];
$p_name = $_POST[p_name];

$target_dir = "uploads/";
$target_file_1 = null;

$target_file_1 = $target_dir . time() .  basename($_FILES["fileToUpload_1"]["name"]);

$uploadOk = 1;
$imageFileType = pathinfo($target_file_1,PATHINFO_EXTENSION);
echo $target_file_1;
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload_1"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file_1)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload_1]"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $target_file_1 = null;
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload_1"]["tmp_name"], $target_file_1)) {
        echo "The file ". basename( $_FILES["fileToUpload_1"]["name"]). " has been uploaded.";


    } else {
        echo "Sorry, there was an error uploading your file_1.";
    }
}
//image upload[1]

$target_dir = "uploads/";
$target_file_2 = null;

$target_file_2 = $target_dir . time() .  basename($_FILES["fileToUpload_2"]["name"]);

$uploadOk = 1;
$imageFileType = pathinfo($target_file_2,PATHINFO_EXTENSION);
echo $target_file_2;
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload_2"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file_2)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload_2]"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $target_file_2 = null;
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload_2"]["tmp_name"], $target_file_2)) {
        echo "The file ". basename( $_FILES["fileToUpload_2"]["name"]). " has been uploaded.";


    } else {
        echo "Sorry, there was an error uploading your file_2.";
    }
}
//image upload[2]


$user_id = $_SESSION[user_id];



$sql = "INSERT INTO store(p_name,p_price,p_head,p_body,p_image_front,p_image_back) VALUE('{$p_name}','{$p_price}','{$p_head}','{$p_body}','{$target_file_1}','{$target_file_2}')";
$ret = mysql_query( $sql );
if ( $ret ){
    echo "<script> alert('게시글 등록 완료');</script>";
}else{
    echo "<script> alert('게시글 등록 실패');</script>";
}

echo $p_price;

?>

<meta http-equiv='refresh'content="0;url='http://127.0.0.1/store.html'">
