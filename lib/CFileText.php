<?php
/**
* Process file text.
*/

class CFileText extends CFile
{
	/**
	* Get a line from text file.
	* @param mixed $file
	*	a file pointer resource
	* @return string
	*	gets line from file pointer
	*/
	public static function get_line($file)
	{
		return fgets($file);
	}
	
	/**
	* Save array of string into a file text with given file name.
	* @param array $array
	*	array of string
	* @param array $array
	*	the name of the file
	* @return boolean
	*	returns true if successful, or false if failed
	*/
	public static function save($array, $file_name)
	{
		try
		{
			// open file text
			$file = self::open($file_name, CFile::MODE_WRITE);
			
			// save to file
			$total = count($array);
			for ($i = 0; $i < $total; $i++)
			{
				fwrite($file, ($i == 0 ? "" : "\n") . $array[$i]);
			}
			
			// close file text
			self::close($file);
			
			return true;
		}
		catch (Exception $e)
		{
			return false;
		}
	}
}
?>