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
		$src_file = CNameSorter::SOURCE_FILE;
		$dest_file = CNameSorter::DEST_FILE;
		$mode = CFile::MODE_WRITE;
		$arr_value = array(
			"Orson Milka Iddins",
			"Erna Dorey Battelle",
			"Flori Chaunce Franzel",
			"Odetta Sue Kaspar",
			"Roy Ketti Kopfen",
			"Madel Bordie Mapplebeck",
			"Selle Bellison",
			"Leonerd Adda Mitchell Mie Monaghan",
			"Debra Micheli",
			"Hailey Annakin",
			"Leonerd Adda Micheli Monaghan",
			"Avie Annakin"
		);
		$arr_sorted = array(
			"Avie Annakin",
			"Hailey Annakin",
			"Erna Dorey Battelle",
			"Selle Bellison",
			"Flori Chaunce Franzel",
			"Orson Milka Iddins",
			"Odetta Sue Kaspar",
			"Roy Ketti Kopfen",
			"Madel Bordie Mapplebeck",
			"Debra Micheli",
			"Leonerd Adda Micheli Monaghan",
			"Leonerd Adda Mitchell Monaghan"
		);
		
		// utility: prepare file
		try
		{
			CFileText::save($arr_value, $src_file);
		}
		catch (Exception $e)
		{
			$bValid = false;
		}
        $this->assertEquals(true, $bValid);
		
		// test: sort names
		try
		{
			CNameSorter::execute();
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
			$file = CFile::open($dest_file, $mode);
			
			// read the file line by line
			$i = 0;
			while (!feof($file))
			{
				$line = trim(CFileText::get_line($file));
				$this->assertEquals($arr_sorted[$i], $line);
				$i++;
			}
			CFile::close($file);
			
			$this->assertEquals(count($arr_sorted), $i);
		}
		catch (Exception $e)
		{
			$bValid = false;
		}
        $this->assertEquals(true, $bValid);
    }
}
?>