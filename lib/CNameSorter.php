<?php
/**
* Sort names from a file text.
*/

class CNameSorter
{
	// source of file text
	const SOURCE_FILE = "unsorted-names-list.txt";
	// destination of file text to write the result
	const DEST_FILE = "sorted-names-list.txt";
	// min and max of given names
	const MIN_NAMES = 1;
	const MAX_NAMES = 3;
	
	/**
	* Sort name from app-defined file text, then display to screen and store at file text.
	* Source file name: SOURCE_FILE
	* Destination file name: DEST_FILE
	*/
	public function execute()
	{
		//echo ">> CNameSorter.execute()" ."<br>";
		
		// open file text
		$file = CFileText::open(self::SOURCE_FILE, CFile::MODE_READONLY);
		
		if (!$file)
		{
			echo "Failed to open file";
			return;
		}
		
		$i = 0;
		//echo "<br>". "Names:" ."<br>";
		//$arr_name = array();
		$arr_fmt_name = array();
		//echo "arr_name/arr_fmt_name: " . count($arr_name) ."/". count($arr_fmt_name) ."<br>";
		
		// read the file line by line
		//while (($line = CFileText::get_line($file)) !== false)
		while (!feof($file))//->eof())
		{
			//$line = trim($line);
			$line = trim(CFileText::get_line($file));
			
			// skip to next line if blank
			if (strlen($line) === 0)
				continue;
			
			//echo "[". $i ."] ";
			$i++;
			//echo "[".$i."] " . $line ."#<br>";
			//$arr_name[] = $line;
			//echo "arr_name: " . count($arr_name) ."<br>";
			
			$fmt_name = self::format_name($line);
			//echo $fmt_name ."#<br>";
			$arr_fmt_name[] = $fmt_name;
			//echo "arr_fmt_name: " . count($arr_fmt_name) ."<br>";
		}
		
		// close file text
		CFileText::close($file);
		
		// Sort names
		//$sorter = new CMergeSort();
		//$arr_fmt_name = $sorter->execute($arr_fmt_name);
		$arr_fmt_name = (new CMergeSort())->execute($arr_fmt_name);
		$total = count($arr_fmt_name);
		echo "<br>". "Result (". $total ."): " ."<br>";
		//echo "arr_fmt_name.count: " . $total ."<br>";
		for ($i = 0; $i < $total; $i++)
		{
			//echo "[". $i ."]";
			echo $arr_fmt_name[$i] ."#<br>";
		}
		
		self::save_to_file($arr_fmt_name);
	}
	
	/**
	* Format name: last name followed by given names.
	* @param string $name
	*	name from text file
	* @return string|null
	*	formatted name
	*/
	private static function format_name($name)
	{
		$arr_result = explode(" ", $name);
		//echo "arr_result.count: " . count($arr_result) ."<br>";
		
		$total = count($arr_result);
		// ignore current name with condition:
		//	below minimum given names (exclude last name)
		if ($total < self::MIN_NAMES + 1)
			return null;
		
		// default: last name
		$result = $arr_result[$total - 1];
		
		// get max given names with condition:
		//	maximum given names, or given names
		//	 (exclude last name)
		$max = ($total > self::MAX_NAMES + 1 ? self::MAX_NAMES : $total - 1);
		//echo "max/total: " . $max . "/" . $total . "<br>";
		
		for($i = 0; $i < $max; $i++)
			$result = $result . " " . $arr_result[$i];
		
		//echo "result: " . $result ."<br>";
		//echo $result ."<br>";
		return $result;
	}
	
	/**
	* Format name: last name followed by given names.
	* @param string $name
	*	name from text file
	* @return string|null
	*	formatted name
	*/
	private static function save_to_file($arr)
	{
		$result = CFileText::save($arr, self::DEST_FILE);
		if (!$result)
			echo "Error occured." ."<br>";
		else
			echo "Job done." ."<br>";
	}
}
?>