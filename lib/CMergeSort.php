<?php
/**
* Merge Sort method.
*/

class CMergeSort
{
	// store array of string for entire process of sorting
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
		$this->arr = $values;
		$this->merge_sort(0, count($this->arr) - 1);
		return $this->arr;
	}
	
	/**
	* Divides array in two halves, calls itself for the two halves and then merge them.
	* @param integer $left
	*	first index of sub-array
	* @param integer $right
	*	last index of sub-array
	*/
	private function merge_sort($left, $right)
	{
		// exit when size = 1 (avoid infinite loop)
		if ($left == $right)
			return;
		
		$mid = intval(($left + $right) / 2);
		// divide the unsorted list into 2 sublists
		$this->merge_sort($left, $mid);
		$this->merge_sort($mid + 1, $right);
		// sort: merge sublists
		$this->merge($left, $mid, $right);
	}
	
	/**
	* Sort sub-array ascending, while maintain memory usage.
	* @param integer $left
	*	first index of sub-array
	* @param integer $mid
	*	mid index of sub-array
	* @param integer $right
	*	last index of sub-array
	* @return mixed
	*	sorted array
	*/
	private function merge($left, $mid, $right)
	{
		// store index and value for each sub-array (v: value, x: index)
		$x1 = $left;
		$x2 = $mid + 1;
		$v1 = $this->arr[$x1];
		$v2 = $this->arr[$x2];
		
		$temp = array();
		
		// $i: index to store sorted value
		for ($i = $left; $i <= $right; $i++)
		{
			// store value to avoid losing
			if ($i > $x1)
				$temp[$i] = $this->arr[$i];
			
			// condition: 1st sub-array have smaller value
			if ($x1 <= $mid && ($x2 > $right || $v1 <= $v2))
			{
				// store value when index not equal
				if ($i != $x1)
					$this->arr[$i] = $v1;
				
				$x1++;
				
				// refresh value of 1st sub-array
				if ($x1 <= $mid)
				{
					// get value from temporary if available
					if (array_key_exists($x1, $temp))
						$v1 = $temp[$x1];
					else
						$v1 = $this->arr[$x1];
				}
			}
			else
			{
				// store value when index not equal
				if ($i != $x2)
					$this->arr[$i] = $v2;
				
				$x2++;
				
				// refresh value of 2nd sub-array
				if ($x2 <= $right)
					$v2 = $this->arr[$x2];
			}
		}
	}
}
?>