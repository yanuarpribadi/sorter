<?php
require_once "lib/lib.php";
use PHPUnit\Framework\TestCase;

class CFileTextTest extends TestCase
{
	/**
	* Test Save text and read them.
	*/
    public function test()
	{
		$bValid = true;
		$file_name = "text.txt";
		$mode = CFile::MODE_WRITE;
		$arr_value = array("abc", "def");
		
		// utility: prepare file
		try
		{
			CFileText::save($arr_value, $file_name);
		}
		catch (Exception $e)
		{
			$bValid = false;
		}
        $this->assertEquals(true, $bValid);
		
		// test: get lines
		$mode = CFile::MODE_READONLY;
		try
		{
			$file = CFile::open($file_name, $mode);
			
			// read the file line by line
			$i = 0;
			while (!feof($file))
			{
				$line = trim(CFileText::get_line($file));
				$this->assertEquals($arr_value[$i], $line);
				$i++;
			}
			CFile::close($file);
			
			$this->assertEquals(count($arr_value), $i);
		}
		catch (Exception $e)
		{
			$bValid = false;
		}
        $this->assertEquals(true, $bValid);
    }
}
?>