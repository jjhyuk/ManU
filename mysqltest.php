<!DOCTYPE html>
<head>
<meta http-equlv="Content-Type" content="text/html; charset=utf-8"/>
<title>MySql-PHP TEST</title>
</head>
<body>
<?php
echo "MySql Test<br>";
$db = mysql_connect("localhost","root","sql","world");
if($db){
echo "connect:success<br>";
}
else{
echo "disconnect:fail<br>";
}
?>
</body>
</html>
