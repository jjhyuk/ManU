<?php
$s = array('s','d','d','q');
array_push($s,'a');
$a = array_unique($s);
setcookie('test',serialize($s),time()+60);
echo setcookie('test',$s,time()+60*60);
$cok = unserialize($_COOKIE['test']);

print_r($a);
echo empty($a[1]);
echo "string";

?>
