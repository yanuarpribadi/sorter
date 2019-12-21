<?php
require_once "lib/lib.php";
use PHPUnit\Framework\TestCase;

class CFileTest extends TestCase
{
	/**
	* Test Open/Close a file.
	*/
    public function test()
	{
		$bValid = true;
		$file_name = "text.txt";
		$mode = CFile::MODE_WRITE;
		
		// test: create/open file
		try
		{
			$file = CFile::open($file_name, $mode);
			CFile::close($file);
		}
		catch (Exception $e)
		{
			$bValid = false;
		}
        $this->assertEquals(true, $bValid);
		
		// test: open existing file
		$mode = CFile::MODE_READONLY;
		try
		{
			$file = CFile::open($file_name, $mode);
			CFile::close($file);
		}
		catch (Exception $e)
		{
			$bValid = false;
		}
        $this->assertEquals(true, $bValid);
		
		// test: open non-existing file
		$file_name = "text123.txt";
		try
		{
			$file = CFile::open($file_name, $mode);
			CFile::close($file);
		}
		catch (Exception $e)
		{
			$bValid = false;
		}
        $this->assertEquals(false, $bValid);
    }
}
?>