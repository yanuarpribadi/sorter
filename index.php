<?php
require_once "lib/lib.php";

echo "Hello world" ."<br>";

$executionStartTime = microtime(true);
$sorter = new CNameSorter();
$sorter->execute();
$executionEndTime = microtime(true);
$seconds = $executionEndTime - $executionStartTime;
echo "<br>". "Execution time: ". $seconds ." second<br>";
/*
$file = new CFile();
echo $file->var1 ."<br>";

$ftxt = $file->open("unsorted-names-list.txt");
if ($ftxt)
	echo "Success" ."<br>";
else
	echo "Failed" ."<br>";
*/
?>