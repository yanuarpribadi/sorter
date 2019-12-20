<?php
/**
* An implementation of var_export() that is compatible with instances
* of stdClass.
* @param mixed $variable The variable you want to export
* @param bool $return If used and set to true, improved_var_export()
*     will return the variable representation instead of outputting it.
* @return mixed|null Returns the variable representation when the
*     return parameter is used and evaluates to TRUE. Otherwise, this
*     function will return NULL.
*/

class CFile
{
	public $var1 = "text var1";
	/*
	private $var2 = "text var2";
	protected $var3 = "text var3";
	*/
	
	// Open a file for read only. File pointer starts at the beginning of the file
	private $FILE_MODE = "r";
	
	/**
	* Open a file.
	* @param string $file_name
	*	the name of the file to be opened
	* @return mixed|false
	*	a file pointer resource on success, or FALSE on failure
	*/
	public function open($file_name)
	{
		return fopen($file_name, $this->FILE_MODE);
		/*
		try
		{
			return fopen($file_name, $this->FILE_MODE) or die("Unable to open file!");
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		*/
	}
}
?>