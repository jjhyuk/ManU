<?<br />
	$Conn = mysql_connect(“localhost”, “root”, “sql”);<br />
	mysql_selectdb(“userProfile”);</p>
<p>	$user = $_POST[‘user’];<br />
	$chat = $_POST[‘chat’];<br />
	$date = date(“Y/m/d H:i:s”);</p>
<p>	mysql_query(“INSERT INTO table (user, chat, date) VALUES (‘$user’, ‘$chat’, ‘$date’)”);<br />
?></p>
<p>
