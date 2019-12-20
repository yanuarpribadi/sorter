<?php
/**
* Merge Sort method.
*/

class CMergeSort
{
	private $arr;
	/**
	* Sort an array ascending.
	* @param array $values
	*	an array to be sorted
	* @return array
	*	sorted array
	*/
	public function execute($values)
	{
		//echo ">> CMergeSort.execute()" ."<br>";
		
		$this->arr = $values;
		$this->merge_sort(0, count($this->arr) - 1);
		return $this->arr;
	}
	
	/**
	* Sort an array ascending.
	* @param array $this->arr
	*	an array to be sorted
	* @param integer $left
	*	first index of sub-array
	* @param integer $right
	*	last index of sub-array
	*/
	private function merge_sort($left, $right)
	{
		//echo "$". $left ."/". $right ."<br>";
		
		// exit when size = 1
		if ($left == $right)
			return;
		
		//echo ">> CMergeSort.merge_sort() ". $left ."/". $right ."<br>";
		
		$mid = intval(($left + $right) / 2);
		$this->merge_sort($left, $mid);
		$this->merge_sort($mid + 1, $right);
		$this->merge($left, $mid, $right);
	}
	
	/**
	* Sort an array ascending.
	* @param mixed $this->arr
	*	an array to be sorted
	* @return mixed
	*	sorted array
	*/
	private function merge($left, $mid, $right)
	{
		//echo ">> CMergeSort.merge() ". $left ."/". $mid ."/". $right ."<br>";
		
		// v: value, x: index
		$x1 = $left;
		$x2 = $mid + 1;
		$v1 = $this->arr[$x1];
		$v2 = $this->arr[$x2];
		
		$temp = array();
		
		// $i: index to store sorted value
		for ($i = $left; $i <= $right; $i++)
		{
			//echo "mid/x1/x2/v1/v2: " . $mid ."/". $x1 ."/". $x2 ." [". $v1 ."][". $v2 ."]" ."<br>";
			
			if ($i > $x1)
			{
				//echo "##if ($i > $x1)" ."#<br>";
				$temp[$i] = $this->arr[$i];
			}
			
			if ($x1 <= $mid && ($x2 > $right || $v1 <= $v2))
			//if (v1 <= v2)
			{
				//echo "**i/x1: ". $i ."/". $x1 ."#";
				if ($i != $x1)
				{
					$this->arr[$i] = $v1;
					//echo " != " ."#<br>";
				}
				//else
					//echo " == " ."#<br>";
					
				//echo "#if: ". $i ."#". $this->arr[$i] ."#<br>";
				$x1++;
				//echo "x1: ". $x1 ."#<br>";
				if ($x1 <= $mid)
				{
					if (array_key_exists($x1, $temp))
						$v1 = $temp[$x1];
					else
						$v1 = $this->arr[$x1];
					//echo "v1: ". $v1 ."#<br>";
				}
			}
			else
			{
				//echo "**i/x2: ". $i ."/". $x2 ."#";
				/*
				$this->arr[$i] = $v2;
				*/
				if ($i != $x2)
				{
					$this->arr[$i] = $v2;
					//echo " != " ."#<br>";
				}
				//else
					//echo " == " ."#<br>";
				
				//$this->arr[$i] = $v2;
				//echo "#else: ". $i ."#". $this->arr[$i] ."#<br>";
				$x2++;
				if ($x2 <= $right)
					$v2 = $this->arr[$x2];
			}
		}
	}
}
?>