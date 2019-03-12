<style><br />
	body {background:#444;}<br />
</style></p>
<p><?<br />
	$Conn = mysql_connect(“localhost”, “DB ID”, “DB PW”);<br />
	mysql_selectdb(“DB NAME”);</p>
<p>	$data = mysql_query(“SELECT * FROM table ORDER BY no DESC”);</p>
<p>	while ($row = mysql_fetch_array($data))<br />
	{<br />
		echo(‘<div style=”background:#777; font-weight:bold; color:#DDD; margin-top:10px; padding:10px;”>’);<br />
		echo($row[‘user’].”님의 말 ▶”.$row[‘chat’].”<br>”);<br />
		echo(“</div>”);<br />
	}<br />
?></p>
<p>
