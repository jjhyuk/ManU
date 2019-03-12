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

session_start();
setcookie('whoami',time()-1);

if(!$_SESSION[is_login])
{
  echo "<script>alert('잘못된 접근입니다!');</script>";
  echo "<script>window.history.back();</script>";
  exit();
}

$user_id = $_SESSION[user_id];
$sql = "DELETE FROM session WHERE user_id ='{$user_id}'";
$ret = mysql_query($sql);

session_destroy();

if($ret)
{
  echo "success";
}
else
{
  echo "<script> alert('로그아웃하지 못했습니다');</script>";
}


?>
