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
$no = $_GET["no"];
$sql = "SELECT user_id FROM comment WHERE no = " . $no;


$result = mysql_query($sql);

$row = mysql_fetch_array($result);

session_start();


if(!strcmp($_SESSION[user_id],$row['user_id']))
{
  echo "<script>alert('잘못된 접근입니다!');</script>";
  echo "<script>window.history.back();</script>";
  exit();
}





$sql = "DELETE from comment where board_num=" . $no;
$result = mysql_query($sql) ;
$row = mysql_fetch_array($result);


if($result == true){
	  echo "<script>window.history.back();</script>";
}
else{
	echo "<script>window.history.back();</script>";;
}

?>
