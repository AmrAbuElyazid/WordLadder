<?php namespace App\SEIDS\Heaps\Pairing;
//==============================================================================
// PHP SEIDS: Supplementary, Easily Interchangeable Data Structures
// 
// Copyright 2015, Daniel A.C. Martin
// Distributed under the MIT License.
// (See LICENSE file for details.)
//==============================================================================
use App\SEIDS\Heaps\MinPriorityQueue as MPQ;
class MinPriorityQueue extends MPQ
{
	public function __construct() // [\SplPriorityQueue]
	{
		$this->DataStructure = new PriorityQueueHeap(array($this, 'compare'));
	}
}

