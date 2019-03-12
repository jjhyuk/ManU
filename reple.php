<?php
session_start();
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




$user_id = $_POST['repleId'];
$no = $_POST['repleNo'];
$text = $_POST['content_rep'];
date_default_timezone_set("Asia/Seoul");
$write_date = date("y-m-d H:i:s",time());



$sql = "INSERT INTO comment (comment_num,text,user_id,write_date) values({$no},'{$text}','{$user_id}','{$write_date}')";

if(mysql_query($sql)){
    echo "success";
}else{
        echo "<script>
        alert('문제발생');
        history.back();
    </script>";
}



?>
