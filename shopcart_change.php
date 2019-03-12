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

$cartnum = $_GET['cartnum'];
$change_num = $_GET['change_num'];

$sql = "UPDATE shopcart SET quantity = ".$change_num." where cartnum=".$cartnum;
echo $sql;

$result = mysql_query($sql);

if($result ) {
	  echo "<script>window.history.back()</script>";
}
else {
	echo "Invalid Query";
}
