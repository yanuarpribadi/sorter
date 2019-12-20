<?php
/**
* Opens file to a stream.
*/

class CFile
{
	//public $var1 = "text var1";
	
	// Open a file for read only. File pointer starts at the beginning of the file
	const MODE_READONLY = "r";
	// Open for writing only; place the file pointer at the beginning of the file
	// and truncate the file to zero length. If the file does not exist, attempt to create it. 
	const MODE_WRITE = "w";
	
	/**
	* Open a file.
	* @param string $file_name
	*	the name of the file to be opened
	* @return mixed|false
	*	a file pointer resource on success, or FALSE on failure
	*/
	public static function open($file_name, $mode)
	{
		return fopen($file_name, $mode);
	}
	
	/**
	* Close a file.
	* @param string $file
	*	a file pointer resource
	*/
	public static function close($file)
	{
		fclose($file);
	}
}
?>