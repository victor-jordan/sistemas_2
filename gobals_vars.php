<?php
$var1 = 3;
$var2 = 8;
$result = 0;

function suma(){
	$GLOBALS['result'] = $GLOBALS['var1'] + $GLOBALS['var2'];
	$result = 0;
	ECHO "LOCAL: ".$result."<br>";
}

suma();
echo "GLOBAL: ".$result."<br>";

echo $_SERVER['PHP_SELF'];
echo "<br>";
echo $_SERVER['SERVER_NAME'];
echo "<br>";
echo $_SERVER['HTTP_HOST'];
echo "<br>";
echo $_SERVER['HTTP_REFERER'];
echo "<br>";
echo $_SERVER['HTTP_USER_AGENT'];
echo "<br>";
echo $_SERVER['SCRIPT_NAME'];
?>