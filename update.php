<?php
$db = mysql_connect("localhost","root","sql");
if(!$db)
{

  die('MySQL ERROR:'.mysql_error());
}
$ret = mysql_select_db('userProfile',$db);

if(!ret)
{

  die('MySQL ERROR:'.mysql_error());
}

if(!(isset($_POST["title"]) && isset($_POST["text"])  && isset($_GET["no"]))){
	echo "Invalid value input_isset";
	exit();
}

if((empty($_POST["title"]) || empty($_POST["text"]) || empty($_GET["no"]))){
	echo "Invalid value input_empty";
	exit();
}
$no = $_GET["no"];
$title = $_POST["title"];
$text = $_POST["text"];
echo $text;

$sql = "UPDATE board SET title = '".$title."',text = '".$text."' WHERE no = ".$no;

$result = mysql_query($sql);

if($result ) {
	  echo "<script>location.href='read.html?no= $no ';</script>";
}
else {
	echo "Invalid Query";
}


?>
