<?php
require_once "lib/lib.php";

// get start timestamp
$executionStartTime = microtime(true);

CNameSorter::execute();

// get end timestamp
$executionEndTime = microtime(true);

// show process time
$seconds = $executionEndTime - $executionStartTime;
echo "Execution time: ". $seconds ." second<br>";
?>