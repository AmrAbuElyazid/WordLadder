<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

abstract class Solver extends Model
{
	protected $words;
	protected $lookups;
	protected $word_size;
	protected $orig_index;
	protected $dest_index;
	protected $steps    = null;
	
	public function __construct(&$words, &$lookups, $word_size, $orig_index, $dest_index, $steps = null)
	{
		$this->words      =& $words;
		$this->lookups    =& $lookups;
		$this->word_size   = $word_size;
		$this->orig_index  = $orig_index;
		$this->dest_index  = $dest_index;
		$this->steps       = $steps;
		$this->distance    = $this->distance($orig_index, $dest_index);
	}
	
	abstract public function solve();
	
	protected static function prevalenceScore($solution) // Weakest link
	{
		$return = PHP_INT_MAX;
		$n      = 0;
		
		foreach($solution as $e)
			if($return > $e['prevalence'])
		{
			$return = $e['prevalence'];
		}
		
		return $return;
	}

	/*
	protected static function prevalenceScore($solution) // Geometric mean
	{
		$return = 1;
		$n      = 0;
		
		foreach($solution as $e)
		{
			$return *= $e['prevalence'];
			++$n;
		}
		
		$return = pow($return, 1.0 / (double)$n);
		
		return $return;
	}
	//*/
	
	protected function distance($start, $finish)
	{
		return $this->distanceBetweenWords($this->words[$start]['value'], $this->words[$finish]['value']);
	}
	
	protected static function distanceBetweenWords($start, $finish)
	{
			$r         = false;
			$word_size = strlen($start);
			
			if(strlen($finish) === $word_size)
			{
				$r = 0;
				$n = 0;
				
				while($n < $word_size)
				{
					if($start{$n} != $finish{$n})
					{
						$r++;
					}
				
					$n++;
				}
			}
			
			return $r;
	}
}

