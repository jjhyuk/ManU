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

$quantity = $_POST['p_quantity'];
$size = $_POST['p_size'];
$user_id = $_SESSION[user_id];
$no = $_POST['p_no'];



$sql = "INSERT INTO shopcart (user_id,p_num,size,quantity) VALUES ('{$user_id}',{$no},'{$size}',{$quantity})";


if(mysql_query($sql)){
    echo "success";
}else{
        echo "<script>
        alert('문제발생');
        history.back();
    </script>";
}

 ?>
