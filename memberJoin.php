<?php
$user_id = $_POST[user_id];
$user_pw =$_POST[user_pw];
$email=$_POST[email];


if($user_id!=''&&$user_pw!=''&&email!='')
{

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

  $sql = "SELECT * FROM user WHERE user_id='{$user_id}'";

  $resource =mysql_query($sql);

  $num = mysql_num_rows($resource);

  if($num>0)
  {
    echo "<script>alert('이미 존재하는 아이디입니다');</script>";
    echo "<script>window.history.back();</script>";
    exit(0);
  }

  $sql = "INSERT INTO user(user_id,user_pw,email) VALUE('{$user_id}','{$user_pw}','{$email}')";
  $ret = mysql_query($sql);

  if($ret)
  {
    echo "<script>alert('회원가입되었습니다');</script>";
    echo "success";
    echo "<script>location.href='http://127.0.0.1/login.html';</script>";
  }
  else
  {
    die('MySQL ERROR:'.mysql_error());
    echo "fail";
  }
}
?>
