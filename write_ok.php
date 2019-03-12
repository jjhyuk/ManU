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

$title = $_POST[title];
$text = $_POST[text];

$target_dir = "uploads/";
$target_file = null;

$target_file = $target_dir . time() .  basename($_FILES["fileToUpload"]["name"]);

$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
echo $target_file;
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
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
if ($_FILES["fileToUpload"]["size"] > 50000000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $target_file = null;
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";


    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
//image upload

$user_id = $_SESSION[user_id];

date_default_timezone_set("Asia/Seoul");
$write_time = date("y-m-d H:i:s",time());


$sql = "INSERT INTO board(title,text,user_id,write_time,imageAdr) VALUE('{$title}','{$text}','{$user_id}','{$write_time}','{$target_file}')";
$ret = mysql_query( $sql );
if ( $ret ){
    echo "<script> alert('게시글 등록 완료');</script>";
}else{
    echo "<script> alert('게시글 등록 실패');</script>";
}

?>

<meta http-equiv='refresh'content="0;url='http://127.0.0.1/board.html'">
