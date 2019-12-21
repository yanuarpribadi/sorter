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
	public static function execute()
	{
		// open file text
		$file = CFileText::open(self::SOURCE_FILE, CFile::MODE_READONLY);
		
		if (!$file)
		{
			echo "Failed to open file";
			return;
		}
		
		$arr_name = array();
		
		// read the file line by line
		while (!feof($file))
		{
			$line = trim(CFileText::get_line($file));
			
			// skip to next line if blank
			if (strlen($line) === 0)
				continue;
			
			$fmt_name = self::format_name($line);
			$arr_name[] = $fmt_name;
		}
		
		// close file text
		CFileText::close($file);
		
		// sort names
		$arr_name = (new CMergeSort())->execute($arr_name);
		$total = count($arr_name);
		
		// show result of sorted names
		echo "Sorted list of names (". $total ."): " ."<br>";
		for ($i = 0; $i < $total; $i++)
		{
			$unfmt_name = self::unformat_name($arr_name[$i]);
			$arr_name[$i] = $unfmt_name;
			echo $unfmt_name ."<br>";
		}
		
		// save result to file
		self::save_to_file($arr_name);
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
		
		$total = count($arr_result);
		// ignore current name with condition:
		// below minimum given names (exclude last name)
		if ($total < self::MIN_NAMES + 1)
			return null;
		
		// name composition: last name + given names (based on MAX_NAMES)
		$max = ($total > self::MAX_NAMES + 1 ? self::MAX_NAMES : $total - 1);
		
		// reorder name
		$result = $arr_result[$total - 1];
		for($i = 0; $i < $max; $i++)
			$result = $result . " " . $arr_result[$i];
		
		return $result;
	}
	
	/**
	* Format name: given names followed by last name.
	* @param string $name
	*	formatted name
	* @return string
	*	unformatted name
	*/
	private static function unformat_name($name)
	{
		$arr_result = explode(" ", $name);
		$total = count($arr_result);
		
		// reorder name
		$result = "";
		for($i = 1; $i < $total; $i++)
			$result = $result . $arr_result[$i] . " ";
		$result = $result . $arr_result[0];
		
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
		
		// show message
		if (!$result)
			echo "<br>". "Error occured." ."<br>";
		else
			echo "<br>". "Job done." ."<br>";
	}
}
?>