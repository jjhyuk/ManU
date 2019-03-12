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

$no = $_GET['no'];

echo $no;

$sql = "DELETE FROM shopcart where cartnum =".$no;
if(mysql_query($sql)){
    echo "<script>

    history.back();
</script>";
}else{
        echo "<script>
        alert('문제발생');
        history.back();
    </script>";
}

?>
