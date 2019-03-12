<!DOCTYPE>
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

$sql = "SELECT title, user_id, text, write_time FROM board WHERE no = " . $no;


$result = mysql_query($sql);

$row = mysql_fetch_array($result);

session_start();
if(strcmp($_SESSION[user_id],$row['user_id']))
{
  echo "<script>alert('잘못된 접근입니다!!');</script>";
  echo "<script>window.history.back();</script>";
  exit();
}

?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="edit.css">
	<title>글 수정</title>
</head>
<body>
	<div id="edit">
		<form action="update.php?no=<?= $no ?>" method="post">
			<p>제목 <input type="text" name="title" size="40" value="<?= $row["title"] ?>"></p>
			<p>내용</p>
			<textarea cols="50" rows="20" name="text"><?= $row["text"] ?></textarea> <br>
			<input type="submit" value="수정하기">
		</form>
		<form action="board.html">
			<input type="submit" value="취소">
		</form>
	</div>
</body>
</html>
