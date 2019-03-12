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
$is_ajax=$_POST[is_ajax];
$id =$_POST[user_id];
$pw = $_POST[user_pw];

setcookie('whoami',$id,time()+86400);


$sql = "SELECT * FROM user WHERE user_id = '{$id}' and user_pw = '{$pw}'";

$resource = mysql_query($sql);


$num = mysql_num_rows($resource);

$asoc = mysql_fetch_assoc($resource);

if($num>0)
{
  $sql = "SELECT * FROM session WHERE user_id = '{$id}'";
  $resource = mysql_query($sql);
  $num = mysql_num_rows($resource);

  if($num > 0)
   {
     echo "login";

   }
   else {
     $sess_id = session_id();


     $sql = "INSERT INTO session VALUE($asoc[no],'$id','$sess_id')";
     $ret = mysql_query($sql);

     $_SESSION[user_id]=$id;
     $_SESSION[is_login] = 1;

     echo "success";

   }



}
else
{
  echo "<script>alert('아아디 또는 패스워드가 올바르지 않습니다');</script>";
  echo "<script>location.href='http://127.0.0.1/login.html';</script>";
}


?>
