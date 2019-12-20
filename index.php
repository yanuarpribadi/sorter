<?php
require_once "lib/lib.php";

echo "Hello world" ."<br>";


$file = new CFile();
echo $file->var1 ."<br>";

try
{
	$ftxt = $file->open("unsorted-names-list2.txt");
	if ($ftxt)
		echo "Success" ."<br>";
	else
		echo "Failed" ."<br>";
}
catch (Exception $e)
{
	echo "Failed catch" ."<br>";
}
?>